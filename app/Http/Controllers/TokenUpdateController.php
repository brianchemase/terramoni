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
    public function generatenibstoken()
    {

            $clientId = 'd01e31a6-b91c-48ed-b625-7347c53563b1';
            $clientSecret = 'xNB8Q~TblaLEhkUahMUc9Q3QNBoxpZaylVBFjdbQ';
            $scope = 'd01e31a6-b91c-48ed-b625-7347c53563b1/.default';
            $grantType = 'client_credentials';

            $data = array(
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'scope' => $scope,
                'grant_type' => $grantType,
            );

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://apitest.nibss-plc.com.ng/reset',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => http_build_query($data),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded',
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                echo 'cURL Error #:' . $err;
            } else {
                $responseJson = json_decode($response, true);

                // Extract the values from the response
                $token = $responseJson['access_token'];
                $expiresIn = $responseJson['expires_in'];

                DB::table('tbl_nibbs_token')->insert([
                    'token' => $responseJson['access_token'],
                    'expirey_date' => $responseJson['expires_in']
                ]);

               // echo "Token: $token" . PHP_EOL;
              //  echo "Expires In: $expiresIn seconds" . PHP_EOL;

              return "Token updated successfully";
            }
    }
}
