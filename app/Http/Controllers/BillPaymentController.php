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
        $this->authorization = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiI2NGFmZjZhOTkyNTE4YTFjNjViOGM3YTciLCJleHAiOjE2OTExMzI1NTg5OTF9._LjQxvobTKBmD5K1hOMoWG8HGYElYO9GX4Km9V7ib8s';
    }
    //
    public function pay_electricity(Request $request)
    {

        $request->validate([
            'meter' => 'required',
            'product_id' => 'required',
            'prepaid' => 'required',
            'denomination' => 'required',
            'agent_id' => 'required',
            'client_phone' => 'required',
            'access_pin' => 'required',
        ]);

        $input = request()->all();
        
        $meter = $request->input('meter');
        $denomination = $request->input('denomination');
        $prepaid = $request->input('prepaid');
        $product_id = $request->input('product_id');
        $agent_id = $request->input('agent_id');
        $access_pin = $request->input('access_pin');
        $toNumber = $request->input('client_phone');

        //return $meter;



        $todayDate = date("Ymd");
        $refnumber = $todayDate . rand(1, 50000);

        $System_pin = DB::table('tbl_agents')->orderBy('id', 'desc')->where('agent_id', $agent_id)->select('access_pin')->first()->access_pin;
        // check system pin
        if($access_pin != $System_pin)
        {
            return response()->json([
                'status_code'=> 401,
                'message' => "Invalid Transaction Pin",
            ]);

        }

        $url = "https:/clients.primeairtime.com/api/billpay/electricity/$meter";
        $token = DB::table('tbl_prime_token')->select('token')->orderBy('id', 'desc')->value('token');
        $authorization = "Bearer " .$token; // Retrieve the bearer token from the construct
        //$authorization = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiI2NGFmZjZhOTkyNTE4YTFjNjViOGM3YTciLCJleHAiOjE2OTA3MjAyMDMxNzl9.mBhCclvX7-1oS-cMonOZlxJ2PGOAV0yN5CsKy5zn_KA";
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


       // $agent_id = rand(1, 899);
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
            'agent_id' => $agent_id,
            'customer_reference' => $customer_reference,
            'ItemFee' => $topupAmount,
            'CurrencySymbol' => $paidCurrency,
            'BillerType' => 'Electrical Bill',
        ]);

        DB::table('tbl_commissions')->insert([
            'transaction_id' => $customer_reference,
            'agent_id' => $agent_id,
            'amount' => $topupAmount,
            'commission' => $topupAmount*0.015,
            'date' => $todayDate,
            'type' => 'Debit',
        ]);
        // Extract required values
        $target = $responseData['target'];
        $pin_code = $responseData['pin_code'];
        $units = '';
        if (preg_match('/Units\s*:\s*([\d.]+)/i', $responseData['pin_option1'], $matches)) {
            $units = $matches[1];
        }
        $topup_amount = $responseData['topup_amount'];
        $date = substr($responseData['time'], 0, 10); // Extract date part from the ISO 8601 timestamp

        // Create the message
        $message = "mtr:{$target}, Token:{$pin_code}, Units:{$units}, TknAmt: {$topup_amount}, Date: {$date}";

        $response = $this->sendSMS($toNumber, $message);


        // Return the API response in a well-structured manner
        return response()->json($responseData, 200);


    }

    public function getElectricityData()
    {
        // Replace these variables with your actual values
        $apiUrl = 'https:/clients.primeairtime.com/api/billpay/country/NG/electricity';
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

    public function gettVData()
    {
        // Replace these variables with your actual values
        $apiUrl = 'https:/clients.primeairtime.com/api/billpay/country/NG/dstv';
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

    public function List_TVs_products(Request $request)
    {

        $request->validate([
            //'meter' => 'required',
            'product_id' => 'required',
            //'prepaid' => 'required',
           // 'denomination' => 'required',
           // 'agent_id' => 'required',
           // 'client_phone' => 'required',
        ]);

        $input = request()->all();
            
        $product_id = $request->input('product_id');

        $todayDate = date("Ymd");
        $refnumber = $todayDate . rand(1, 50000);

        $apiUrl = "https://clients.primeairtime.com/api/billpay/dstv/$product_id";
        $authorization = DB::table('tbl_prime_token')->select('token')->orderBy('id', 'desc')->value('token');
        //$authorization = "Bearer " .$token; // Retrieve the bearer token from the construct
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


    public function payforTv(Request $request)
    {
        $request->validate([
            'accno' => 'required',
            'amount' => 'required',
            'agent_id' => 'required',
            'access_pin' => 'required',
        ]);
        $input = request()->all();     
        $accno = $request->input('accno');
        $amount = $request->input('amount');
        $agent_id = $request->input('agent_id');
        $access_pin = $request->input('access_pin');
        $todayDate = date("Ymd");
        $refnumber = $todayDate . rand(1, 50000);



        $System_pin = DB::table('tbl_agents')->orderBy('id', 'desc')->where('agent_id', $agent_id)->select('access_pin')->first()->access_pin;
        // check system pin
        if($access_pin != $System_pin)
        {
            return response()->json([
                'status_code'=> 401,
                'message' => "Invalid Transaction Pin",
            ]);

        }
        // URL to send the POST request to
       // $url = "https://clients.primeairtime.com/api/billpay/dstvnew/8063831361";
        $url = "https://clients.primeairtime.com/api/billpay/dstvnew/$accno";

        // Replace this with your Bearer token
        $authorization = DB::table('tbl_prime_token')->select('token')->orderBy('id', 'desc')->value('token');
        $agent = DB::table('tbl_agents')
        ->select('first_name', 'last_name')
        ->where('id', $agent_id)
        ->first();

            $agent_names = null;
            if ($agent) {
                $agent_names = $agent->first_name . ' ' . $agent->last_name;
            }

        // Data to send in the POST request
        $data = array(
            'amount' => $amount,
            "customer_reference" => $refnumber
            // Add more parameters as needed
        );

        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $authorization, // Add the Bearer token to the request headers
        ]);

        // Execute cURL session and get the response
        $response = curl_exec($ch);
        //return $response;

        // Check if there is a response
        if (empty($response)) {
            // Handle the error here
            $error = curl_error($ch); // Get the error message
            curl_close($ch); // Close the cURL session
            
            // Return an error response or log the error as needed
            return response()->json(['error' => $error], 500); // Example JSON error response
        }
      
        // Assuming $response contains the JSON response received from the API
        $responseData = json_decode($response, true);

        $productId = $responseData['product_id'];
        $target = $responseData['target'];
        //$agent_names = 'your_agent_name'; // Replace with your agent's name
        //$agent_id = 'your_agent_id'; // Replace with your agent's ID
        $customer_reference = $responseData['reference'];
        $topupAmount = $responseData['topup_amount'];
        $paidCurrency = $responseData['paid_currency'];

        $todayDate = now(); // You can adjust this according to your date format needs

        // Store the data into the tbl_transactions table using the DB facade
        DB::table('tbl_transactions')->insert([
            'Name' => $productId,
            'BillerName' => $target,
            'ConsumerIdField' => $agent_names,
            'agent_id' => $agent_id,
            'customer_reference' => $customer_reference,
            'ItemFee' => $topupAmount,
            'CurrencySymbol' => $paidCurrency,
            'BillerType' => 'TV Payment Bill',
           // 'created_at' => $todayDate,
           // 'updated_at' => $todayDate,
        ]);

        // Calculate commission
        $commission = $topupAmount * 0.015;

        DB::table('tbl_commissions')->insert([
            'transaction_id' => $customer_reference,
            'agent_id' => $agent_id,
            'amount' => $topupAmount,
            'commission' => $commission,
            'date' => $todayDate,
            'type' => 'Debit',
            //'created_at' => $todayDate,
            //'updated_at' => $todayDate,
        ]);

        return $response;

        // Check for cURL errors
        if (curl_errno($ch)) {
            return 'cURL Error: ' . curl_error($ch);
        }

        // Close cURL session
        curl_close($ch);

        // You can handle the response as needed, such as returning it or saving it to a database
        return $response;
    }

    public function checkTvAccount(Request $request)
    {
        $request->validate([
            'accno' => 'required',
            //'amount' => 'required',
            //'agent_id' => 'required',
        ]);
        $input = request()->all();     
        $accno = $request->input('accno');
        //$amount = $request->input('amount');
        //$agent_id = $request->input('agent_id');
        $todayDate = date("Ymd");
        $refnumber = $todayDate . rand(1, 50000);
        // URL to send the get request to
       
        $url = "https://clients.primeairtime.com/api/billpay/dstvnew/$accno";

        // Replace this with your Bearer token
        $authorization = DB::table('tbl_prime_token')->select('token')->orderBy('id', 'desc')->value('token');
     
                // Initialize cURL session
                $ch = curl_init();

                // Set the cURL options
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HTTPGET, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Authorization: Bearer ' . $authorization, // Add the Bearer token to the request headers
                ]);

                // Execute the cURL request
                $response = curl_exec($ch);

                // Check for cURL errors
                if (curl_errno($ch)) {
                    echo 'cURL error: ' . curl_error($ch);
                }

                // Close the cURL session
                curl_close($ch);
                    // Parse the JSON response
                    $responseData = json_decode($response, true);

                    // Check if parsing was successful
                    if ($responseData === null) {
                        return response('Error: Unable to parse JSON response', 500);
                    }
                    return response()->json($responseData);

        
    }
   
    public function getTvDataListing(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            //'amount' => 'required',
            //'agent_id' => 'required',
        ]);

        $product_id = $request->input('product_id');
       // return $product_id;
        // Replace these variables with your actual values
        $apiUrl = "https://clients.primeairtime.com/api/billpay/dstv/$product_id";
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
    public function getInternetData()
    {
        // Replace these variables with your actual values
        $apiUrl = 'https://clients.primeairtime.com/api/billpay/country/NG/internet';
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

    public function pay_internet(Request $request)
    {

        $request->validate([
            'meter' => 'required',
            'product_id' => 'required',
            'prepaid' => 'required',
            'denomination' => 'required',
            //'product_code' => 'required',
            'agent_id' => 'required',
            'access_pin' => 'required',
            //'client_phone' => 'required',
        ]);

        $input = request()->all();
        
        $meter = $request->input('meter');
        $denomination = $request->input('denomination');
        $prepaid = $request->input('prepaid');
        $product_id = $request->input('product_id');
        $access_pin = $request->input('access_pin');
        $agent_id = $request->input('agent_id');
        $toNumber = $request->input('client_phone');

        $todayDate = date("Ymd");
        $refnumber = $todayDate . rand(1, 50000);
        $System_pin = DB::table('tbl_agents')->orderBy('id', 'desc')->where('agent_id', $agent_id)->select('access_pin')->first()->access_pin;
        // check system pin
        if($access_pin != $System_pin)
        {
            return response()->json([
                'status_code'=> 401,
                'message' => "Invalid Transaction Pin",
            ]);

        }

        $url = "https:/clients.primeairtime.com/api/billpay/internet/$product_id/$denomination";
        $token = DB::table('tbl_prime_token')->select('token')->orderBy('id', 'desc')->value('token');
        $authorization = "Bearer " .$token; // Retrieve the bearer token from the construct

        $data = [
            "product_id" => $product_id,
            "prepaid" => $prepaid,
            "denomination" => $denomination,
            "meter" => $meter,
           
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

        return $response;
        

        if ($response === false) {
            
            return response()->json(['error' => 'cURL Error: ' . curl_error($ch)], 500);
           
        }

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
            'agent_id' => $agent_id,
            'customer_reference' => $customer_reference,
            'ItemFee' => $topupAmount,
            'CurrencySymbol' => $paidCurrency,
            'BillerType' => 'Internet Bill',
        ]);

        DB::table('tbl_commissions')->insert([
            'transaction_id' => $customer_reference,
            'agent_id' => $agent_id,
            'amount' => $topupAmount,
            'commission' => $topupAmount*0.015,
            'date' => $todayDate,
            'type' => 'Debit',
        ]);
        // Extract required values
        $target = $responseData['target'];
        $pin_code = $responseData['pin_code'];
        $units = '';
        if (preg_match('/Units\s*:\s*([\d.]+)/i', $responseData['pin_option1'], $matches)) {
            $units = $matches[1];
        }
        $topup_amount = $responseData['topup_amount'];
        $date = substr($responseData['time'], 0, 10); // Extract date part from the ISO 8601 timestamp

        // Create the message
        $message = "mtr:{$target}, Token:{$pin_code}, Units:{$units}, TknAmt: {$topup_amount}, Date: {$date}";

        $response = $this->sendSMS($toNumber, $message);


        // Return the API response in a well-structured manner
        return response()->json($responseData, 200);


    }





    private function sendSMS(string $toNumber, string $message)
    {
        // Replace these with your actual credentials
        $apiKey = '4e3f3b621a7b0aabb13f1691729e83f0eff6ab05dbaa6173f46d9cc7f6d56dc5';
        $username = "dennis.mwebia";
        $authorization = base64_encode($username . ':' . $apiKey);

        
        // URL to the API endpoint
        $url = 'https://api.africastalking.com/version1/messaging';

        // Request data
        $data = [
            'username' => $username,
            'to' => $toNumber,
            'message' => $message,
           //'from' => 'myShortCode', // Change this if needed
        ];

        
        // Set the API key in the headers
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'apiKey' => $apiKey,
        ];

         // Initialize cURL session
        // Create cURL resource
            $ch = curl_init();

            // Set cURL options
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Accept: application/json',
                'Content-Type: application/x-www-form-urlencoded',
                'apiKey: ' . $apiKey
            ));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Execute the cURL request and store the response
            $response = curl_exec($ch);

            // Check for cURL errors
            if (curl_errno($ch)) {
                echo 'cURL error: ' . curl_error($ch);
            }

            // Close cURL resource
            curl_close($ch);

            // Output the response from the API
            //echo $response;
    }
}
