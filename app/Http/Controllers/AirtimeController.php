<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


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

        // $response = Http::withHeaders([
        //     "Content-Type" => "application/json",
        //     "Authorization" => $authorization
        // ])->post($url, $data);

        //return $response;

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

        // if ($response->failed()) {
        //     return response()->json(['error' => 'API Request Failed'], 500);
        // }

        // return response()->json(['response' => $response->json()], 200);

        if ($response === false) {
            
            return response()->json(['error' => 'cURL Error: ' . curl_error($ch)], 500);
           // return response()->json(['error' => 'API Request Failed'], 500);
        }

       // Process the API response
    $responseData = json_decode($response, true);

    // Return the API response in a well-structured manner
    return response()->json($responseData, 200);
       // return response()->json(['response' => $response->json()], 200);
        
    }
}
