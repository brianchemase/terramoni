<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillPaymentController extends Controller
{

    private $authorization;

    public function __construct()
    {
        // Assign initial value to $authorization
        $this->authorization = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiI2NGFmZjZhOTkyNTE4YTFjNjViOGM3YTciLCJleHAiOjE2OTA3MjAyMDMxNzl9.mBhCclvX7-1oS-cMonOZlxJ2PGOAV0yN5CsKy5zn_KA';
    }
    //
    public function pay_electricity(Request $request)
    {
        $input = request()->all();
        
        $meter = $request->input('meter');
        $denomination = $request->input('denomination');
        $prepaid = $request->input('prepaid');
        $product_id = $request->input('product_id');

        //return $meter;



        $todayDate = date("Ymd");
        $refnumber = $todayDate . rand(1, 50000);

        $url = "https:/clients.primeairtime.com/api/billpay/electricity/$meter";
       // $authorization = "Bearer " . env('PRIME_BEARER_TOKEN'); // Retrieve the bearer token from the .env file
        $authorization = "Bearer " . $this->authorization; // Retrieve the bearer token from the construct
        //$authorization = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiI2NGFmZjZhOTkyNTE4YTFjNjViOGM3YTciLCJleHAiOjE2ODk3ODc1MzA4ODd9.TDwvq6TXVXhATAr_Z_vI5yHqDDAFoNenPfSIZ544LQw";
        //$authorization = $this->authorization;
        //return $authorization;
        $data = [
            "product_id" => $product_id ,
            "prepaid" => $prepaid,
            "denomination" => $denomination,
            "product_id" => $product_id,
           
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
            
            return response()->json(['error' => 'cURL Error: ' . curl_error($ch)], 500);
           // return response()->json(['error' => 'API Request Failed'], 500);
        }


        $agent_id = rand(1, 899);
        $agent = DB::table('tbl_agents')
            ->select('first_name', 'last_name')
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
    
        // Store the data into the tbl_transactions table using the DB facade
        DB::table('tbl_transactions')->insert([
            'Name' => $productId,
            'BillerName' => $target,
            'ConsumerIdField' => $agent_names,
            'customer_reference' => $customer_reference,
            'ItemFee' => $topupAmount,
            'CurrencySymbol' => $paidCurrency,
            'BillerType' => 'Electrical Bill',
        ]);


        // Return the API response in a well-structured manner
        return response()->json($responseData, 200);


    }

    public function getElectricityData()
    {
        // Replace these variables with your actual values
        $apiUrl = 'https:/clients.primeairtime.com/api/billpay/country/NG/electricity';
        //$accessToken = 'YOUR_BEARER_TOKEN';
        $authorization = $this->authorization; // Retrieve the bearer token from the construct

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
}
