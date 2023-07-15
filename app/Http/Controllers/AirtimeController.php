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

        $url = "https:/clients.primeairtime.com//api/topup/exec/$phoneNumber";
        $authorization = "Bearer " . env('PRIME_BEARER_TOKEN'); // Retrieve the bearer token from the .env file
        //$authorization = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiI2NGFmZjZhOTkyNTE4YTFjNjViOGM3YTciLCJleHAiOjE2ODk2MDkwNDQ2NjF9.oXthjBundp0Zq-4MOCghUkZ9mEEg6EndfThQGdqjBBs";
        $data = [
            "product_id" => "MFIN-5-OR",
            "denomination" => $denomination,
            "send_sms" => false,
            "sms_text" => "",
            "customer_reference" => "myref204020020e2e30dk"
        ];

        $response = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => $authorization
        ])->post($url, $data);

        if ($response->failed()) {
            return response()->json(['error' => 'API Request Failed'], 500);
        }

        return response()->json(['response' => $response->json()], 200);
    }
}
