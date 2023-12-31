<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;


class AirtimeController extends Controller
{
    private $authorization;

    public function __construct()
    {
        // Assign initial value to $authorization
        $this->authorization = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiI2NGFmZjZhOTkyNTE4YTFjNjViOGM3YTciLCJleHAiOjE2OTExMzI1NTg5OTF9._LjQxvobTKBmD5K1hOMoWG8HGYElYO9GX4Km9V7ib8s';
    }


    //
    public function topup(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
            'denomination' => 'required',
            'product_id' => 'required',
            'agent_id' => 'required',
           // 'acess_pin' => 'required',
        ]);

        $phoneNumber = $request->input('phone_number');
        $denomination = $request->input('denomination');
        $product_id = $request->input('product_id');
        $agent_id = $request->input('agent_id');
       // $acess_pin = $request->input('acess_pin');
        $todayDate = date("Ymd");
        $refnumber = $todayDate . rand(1, 50000);

        $System_pin = DB::table('tbl_agents')->orderBy('id', 'desc')->where('id', $agent_id)->select('access_pin')->first()->access_pin;
                    // check system pin
                    // if($access_pin != $System_pin)
                    // {
                    //     return response()->json([
                    //         'status_code'=> 401,
                    //         'message' => "Invalid Transaction Pin",
                    //     ]);

                    // }

        $url = "https:/clients.primeairtime.com/api/topup/exec/$phoneNumber";
       // $authorization = "Bearer " . env('PRIME_BEARER_TOKEN'); // Retrieve the bearer token from the .env file
       $token = DB::table('tbl_prime_token')->select('token')->orderBy('id', 'desc')->value('token');
        $authorization = "Bearer " .$token; // Retrieve the bearer token from the construct
        //$authorization = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiI2NGFmZjZhOTkyNTE4YTFjNjViOGM3YTciLCJleHAiOjE2ODk3ODc1MzA4ODd9.TDwvq6TXVXhATAr_Z_vI5yHqDDAFoNenPfSIZ544LQw";
        //$authorization = $this->authorization;
        //return $authorization;
        $data = [
            "product_id" => $product_id,
            "denomination" => $denomination,
            "send_sms" => false,
            "sms_text" => "",
            "customer_reference" => $refnumber
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Authorization: $authorization"
        ));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        //return $response;
        

        if ($response === false) {
            
            //return response()->json(['error' => 'cURL Error: ' . curl_error($ch)], 500);
            return response()->json([
                'status_code'=> 500,
                'message' => "Internal System Error",
            ]);
           // return response()->json(['error' => 'API Request Failed'], 500);
        }


        //$agent_id = rand(1, 899);
        $agent = DB::table('tbl_agents')
            //->select('first_name', 'last_name', 'agent_tier_id', '')
            ->where('id', $agent_id)
            ->first();

        $agent_names = null;
        if ($agent) {
            $agent_names = $agent->first_name . ' ' . $agent->last_name;
            $agent_tier= $agent->agent_tier_id;
            //return $agent_tier;
        }
        

       // Process the API response
        $responseData = json_decode($response, true);

        // Extract the desired data from the API response
        $productId = $responseData['product_id'];
        $target = $responseData['target'];
        $topupAmount = $responseData['topup_amount'];
        $paidCurrency = $responseData['paid_currency'];
        $customer_reference = $responseData['customer_reference'];
    
        // Store the data into the tbl_transactions table using the DB facade
        DB::table('tbl_transactions')->insert([
            'Name' => $productId,
            'BillerName' => $target,
            'ConsumerIdField' => $agent_names,
            'agent_id' => $agent_id,
            'customer_reference' => $customer_reference,
            'ItemFee' => $topupAmount,//customer_reference
            'transaction_type' => 'billpayment',
            'CurrencySymbol' => $paidCurrency,
            'BillerType' => 'Airtime Top up',
        ]);


        // DB::table('tbl_commissions')->insert([
        //     'transaction_id' => $customer_reference,
        //     'agent_id' => $agent_id,
        //     'amount' => $topupAmount,
        //     'commission' => $topupAmount*0.015,
        //     'date' => $todayDate,
        //     'type' => 'Debit',
        // ]);

        $data = [
            'agent_type' => 'Agent',
            'transaction_type' => '1',
            'agent_id' => $agent_id,
            'agent_tier' => $agent->agent_tier_id,
            'biller_id' => '1',
            'wallet_id' => $agent->bank_acc_no,//bank_acc_no
            'transaction_amount' => $topupAmount,
            'transaction_id' => $customer_reference,
            // Add other data fields as needed
        ];
        //calculate and make commissions
        $commission = $this->ApplyCommission($data);


        // Access the value of topup_amount
        $topupAmount = $responseData['topup_amount'];

        // Set the value of paid_amount to topup_amount
        $responseData['paid_amount'] = $topupAmount;

        // Return the API response in a well-structured manner
       // return response()->json($responseData, 200);
        return response()->json([
            'status_code'=> 200,
            'message' => "Payment made successfull",
            'ResponceData' => $responseData,
        ]);
        
    }

    public function getAirtimeProviders($phone)
    {
        // Replace these variables with your actual values
        $apiUrl = "https://clients.primeairtime.com/api/topup/info/$phone";
        $authorization = DB::table('tbl_prime_token')->select('token')->orderBy('id', 'desc')->value('token');

        // Initialize cURL session
        $ch = curl_init();

        // Set the cURL options
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $authorization,
        ]);

        // Execute the cURL request
        $response = curl_exec($ch);

         // Check for cURL errors
         if (curl_errno($ch)) {
            return response()->json(['error' => 'cURL error: ' . curl_error($ch)], 500);
        }

        return $response;

       

        // Close the cURL session
        curl_close($ch);

        // Output the response as JSON
        return response()->json($response);

    }
    public function getDataProviders($phone)
    {
        // Replace these variables with your actual values
        $apiUrl = "https://clients.primeairtime.com/api/datatopup/info/$phone";
        $authorization = DB::table('tbl_prime_token')->select('token')->orderBy('id', 'desc')->value('token');

        // Initialize cURL session
        $ch = curl_init();

        // Set the cURL options
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $authorization,
        ]);

        // Execute the cURL request
        $response = curl_exec($ch);

        return $response;

        // Check for cURL errors
        if (curl_errno($ch)) {
            return response()->json(['error' => 'cURL error: ' . curl_error($ch)], 500);
        }

        // Close the cURL session
        curl_close($ch);

        // Output the response as JSON
        return response()->json($response);

    }

    public function datatopup(Request $request)
    {

        $request->validate([
            'phone_number' => 'required',
            'product_id' => 'required',
            'denomination' => 'required',
            'agent_id' => 'required',
            //'access_pin' => 'required',
        ]);
        
        $phoneNumber = $request->input('phone_number');
        $denomination = $request->input('denomination');
        $product_id = $request->input('product_id');
        $agent_id = $request->input('agent_id');
        //$access_pin = $request->input('access_pin');
        $todayDate = date("Ymd");
        $refnumber = $todayDate . rand(1, 50000);


        // $System_pin = DB::table('tbl_agents')->orderBy('id', 'desc')->where('id', $agent_id)->select('access_pin')->first()->access_pin;
        // // check system pin
        // if($access_pin != $System_pin)
        // {
        //     return response()->json([
        //         'status_code'=> 401,
        //         'message' => "Invalid Transaction Pin",
        //     ]);

        // }

        $url = "https:/clients.primeairtime.com/api/datatopup/exec/$phoneNumber";
        //$authorization = "Bearer " . env('PRIME_BEARER_TOKEN'); // Retrieve the bearer token from the .env file
       // $authorization = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiI2NGFmZjZhOTkyNTE4YTFjNjViOGM3YTciLCJleHAiOjE2ODk3ODc1MzA4ODd9.TDwvq6TXVXhATAr_Z_vI5yHqDDAFoNenPfSIZ544LQw";
       $token = DB::table('tbl_prime_token')->select('token')->orderBy('id', 'desc')->value('token');
        $authorization = "Bearer " .$token; // Retrieve the bearer token from the construct
        //return $authorization;
        $data = [
            "product_id" => $product_id,
            "denomination" => $denomination,
            "send_sms" => false,
            "sms_text" => "",
            "customer_reference" => $refnumber
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Authorization: $authorization"
        ));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

      // return $response;

        if ($response === false) {
            
            //return response()->json(['error' => 'cURL Error: ' . curl_error($ch)], 500);
           // return response()->json(['error' => 'API Request Failed'], 500);
           return response()->json([
            'status_code'=> 500,
            'message' => "Internal System Error",
                                 ]);
        }


       // $agent_id = rand(1, 899);
        $agent = DB::table('tbl_agents')
           // ->select('first_name', 'last_name')
            ->where('id', $agent_id)
            ->first();

        $agent_names = null;
        if ($agent) {
            $agent_names = $agent->first_name . ' ' . $agent->last_name;
        }
        

       // Process the API response
        $responseData = json_decode($response, true);

        // Extract the desired data from the API response
        $productId = $responseData['product_id'];
        $target = $responseData['target'];
        $topupAmount = $responseData['topup_amount'];
        $paidCurrency = $responseData['paid_currency'];
        $customer_reference = $responseData['customer_reference'];
        $responseData['paid_amount'] = (int)$responseData['paid_amount'];
        $responseData['topup_amount'] = (int)$responseData['topup_amount'];

   
        // Store the data into the tbl_transactions table using the DB facade
        DB::table('tbl_transactions')->insert([
            'Name' => $productId,
            'BillerName' => $target,
            'ConsumerIdField' => $agent_names,
            'agent_id' => $agent_id,
            'customer_reference' => $customer_reference,
            'ItemFee' => $topupAmount,
            'transaction_type' => 'billpayment',
            'CurrencySymbol' => $paidCurrency,
            'BillerType' => 'Data Top up',
        ]);

        // DB::table('tbl_commissions')->insert([
        //     'transaction_id' => $customer_reference,
        //     'agent_id' => $agent_id,
        //     'amount' => $topupAmount,
        //     'commission' => $topupAmount*0.015,
        //     'date' => $todayDate,
        //     'type' => 'Debit',
        // ]);

        $data = [
            'agent_type' => 'Agent',
            'transaction_type' => '2',
            'agent_id' => $agent_id,
            'agent_tier' => $agent->agent_tier_id,
            'biller_id' => '1',
            'wallet_id' => $agent->bank_acc_no,//bank_acc_no
            'transaction_amount' => $topupAmount,
            'transaction_id' => $customer_reference,
            // Add other data fields as needed
        ];
        //calculate and make commissions
        $commission = $this->ApplyCommission($data);


        // Return the API response in a well-structured manner
        return response()->json($responseData, 200);
        
    }

    // $commission = $this->ApplyCommission($data);
    private function ApplyCommission($data)
    {

        $url = "https://portal.datacraftgarage.com/api/calculate-commission";

       
        // Initialize cURL session
        $ch = curl_init($url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        // Execute the cURL session
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            return false; // Request failed
        }

        // Close the cURL session
        curl_close($ch);

        return $response; // Return the response
    }

    
}
