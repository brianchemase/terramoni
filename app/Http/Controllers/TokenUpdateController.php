<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TokenUpdateController extends Controller
{
    //
    public function generatenewtoken()
    {

        $url = 'https://clients.primeairtime.com/api/auth';
    $data = [
        "username" => "kidiaro@terraswitch.ng",
        "password" => "Terraswitch@dairo"
    ];

    // Initialize cURL session
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    // Execute cURL session and get the response
    $response = curl_exec($ch);

    // Close cURL session
    curl_close($ch);

    // You can process the $response variable containing the API response here
    // For example, you can decode the JSON response if it's JSON data:
    $responseData = json_decode($response, true);

    DB::table('tbl_prime_token')->insert([
        'token' => $responseData['token'],
        'expery_date' => $responseData['expires']
    ]);

        return $responseData;
    }

    public function generatenewqoreidtoken()
    {
        $ch = curl_init();

        $data = array(
            "clientId" => "0O9U07T66XBVYR5GWIGO",
            "secret" => "c77f5d1501bc44ec9d87f5eb89af0e95"
        );
        
        $data_string = json_encode($data);
        
        curl_setopt($ch, CURLOPT_URL, "https://api.qoreid.com/token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_POST, 1);
        
        $headers = array(
            'accept: text/plain',
            'content-type: application/json'
        );
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);

    // Execute cURL session and get the response
    $response = curl_exec($ch);

    // Close cURL session
    curl_close($ch);

    // You can process the $response variable containing the API response here
    // For example, you can decode the JSON response if it's JSON data:
    $responseData = json_decode($response, true);

    DB::table('tbl_qoreid_token')->insert([
        'token' => $responseData['accessToken'],
        'expirey_date' => $responseData['expiresIn']
    ]);

        return $responseData;
    }
}
