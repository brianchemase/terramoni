<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;


class AirtimeController extends Controller
{
    //
    public function topup(Request $request)
    {
        $phoneNumber = $request->input('phone_number');
        $denomination = $request->input('denomination');
        $todayDate = date("Ymd");
        $refnumber = $todayDate . rand(1, 50000);

        $url = "https:/clients.primeairtime.com/api/topup/exec/$phoneNumber";
        //$authorization = "Bearer " . env('PRIME_BEARER_TOKEN'); // Retrieve the bearer token from the .env file
        $authorization = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiI2NGFmZjZhOTkyNTE4YTFjNjViOGM3YTciLCJleHAiOjE2ODk2MDkwNDQ2NjF9.oXthjBundp0Zq-4MOCghUkZ9mEEg6EndfThQGdqjBBs";
        $data = [
            "product_id" => "MFIN-5-OR",
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
 
     // Store the data into the tbl_transactions table using the DB facade
     DB::table('tbl_transactions')->insert([
         'Name' => $productId,
         'BillerName' => $target,
         'ConsumerIdField' => $agent_names,
         'ItemFee' => $topupAmount,
         'CurrencySymbol' => $paidCurrency,
         'BillerType' => 'Airtime Top up',
     ]);


    // Return the API response in a well-structured manner
    return response()->json($responseData, 200);
        
    }


    public function datatopup(Request $request)
    {
        $phoneNumber = $request->input('phone_number');
        $denomination = $request->input('denomination');
        $todayDate = date("Ymd");
        $refnumber = $todayDate . rand(1, 50000);

        $url = "https:/clients.primeairtime.com/api/datatopup/exec/$phoneNumber";
        //$authorization = "Bearer " . env('PRIME_BEARER_TOKEN'); // Retrieve the bearer token from the .env file
        $authorization = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiI2NGFmZjZhOTkyNTE4YTFjNjViOGM3YTciLCJleHAiOjE2ODk2MDkwNDQ2NjF9.oXthjBundp0Zq-4MOCghUkZ9mEEg6EndfThQGdqjBBs";
        $data = [
            "product_id" => "D-MFIN-5-50",
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

       return $response;

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
 
     // Store the data into the tbl_transactions table using the DB facade
     DB::table('tbl_transactions')->insert([
         'Name' => $productId,
         'BillerName' => $target,
         'ConsumerIdField' => $agent_names,
         'ItemFee' => $topupAmount,
         'CurrencySymbol' => $paidCurrency,
         'BillerType' => 'Data Top up',
     ]);


    // Return the API response in a well-structured manner
    return response()->json($responseData, 200);
        
    }
}
