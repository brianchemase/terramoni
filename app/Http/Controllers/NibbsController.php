<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class NibbsController extends Controller
{
    //

    public function getInstitutions()
    {
        $token = DB::table('tbl_nibbs_token')->select('token')->orderBy('id', 'desc')->value('token');
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => "Bearer $token",
            ])->get('https://apitest.nibss-plc.com.ng/nipservice/v1/nip/institutions');

            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function nibstoken()
    {
        $token = DB::table('tbl_nibbs_token')->select('token')->orderBy('id', 'desc')->value('token');
        return $token;

    }

    public function checkbalance(Request $request)
    {

        $request->validate([
            'dest_code' => 'required',
            'accountno' => 'required',
            'bvn' => 'required',
           'agent_id' => 'required',
        ]);

       // $phoneNumber = $request->input('phone_number');
        $destinationInstitutionCode="999998";
        $accountno="0112345678";

        $destinationInstitutionCode=$request->input('dest_code');
        $accountno=$request->input('accountno');
        $bvn=$request->input('bvn');
        $agent_id = $request->input('agent_id');


        $token = DB::table('tbl_nibbs_token')->select('token')->orderBy('id', 'desc')->value('token');
        $clientno = '000306'; // Replace with the actual client number
        $today = date("ymd");
        $time = date("His");
        // Generate a random number with exactly 12 characters
        $randomnumber = str_pad(mt_rand(0, 999999999999), 12, '0', STR_PAD_LEFT);

        $transactionId = $clientno . $today . $time . $randomnumber;

        $data = array(
            'channelCode' => '1',
            'targetAccountName' => 'vee Test',
            'targetAccountNumber' => $accountno,
            'targetBankVerificationNumber' => $bvn,
            'authorizationCode' => 'MA-0112345678-2022315-53097',
            'destinationInstitutionCode' => $destinationInstitutionCode,
            'billerId' => 'ADC19BDC-7D3A-4C00-4F7B-08DA06684F59',
            'transactionId' => $transactionId, // Use the generated transactionId
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apitest.nibss-plc.com.ng/nipservice/v1/nip/balanceenquiry",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "content-type: application/json",
                "Authorization: Bearer $token", // Add the bearer token here
            ),
        ));


        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $todayDate = date("Ymd");

            DB::table('tbl_commissions')->insert([
                'transaction_id' => $transactionId,
                'agent_id' => $agent_id,
                'amount' => 0,
                'commission' => 15,
                'date' => $todayDate,
                'type' => 'Debit',
            ]);
           return $response;
        }


    }

    public function fundstransfer(Request $request)
    {

        $apiUrl = "https://apitest.nibss-plc.com.ng/nipservice/v1/nip/fundstransfer";

        // Generate transactionId
        $clientno = '000306'; // Replace with the actual client number
        $today = date("ymd");
        $time = date("His");
        $randomnumber = str_pad(mt_rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
        $transactionId = $clientno . $today . $time . $randomnumber;
        $token = DB::table('tbl_nibbs_token')->select('token')->orderBy('id', 'desc')->value('token');

        // Prepare the request data
        $requestData = array(
            "sourceInstitutionCode" => "999998",
            "amount" => 100,
            "beneficiaryAccountName" => "Ake Mobolaji Temabo",
            "beneficiaryAccountNumber" => "1780004070",
            "beneficiaryBankVerificationNumber" => 22222222226,
            "beneficiaryKYCLevel" => 1,
            "channelCode" => 1,
            "originatorAccountName" => "vee Test",
            "originatorAccountNumber" => "0112345678",
            "originatorBankVerificationNumber" => 33333333333,
            "originatorKYCLevel" => 1,
            "destinationInstitutionCode" => 999998,
            "mandateReferenceNumber" => "MA-0112345678-2022315-53097",
            "nameEnquiryRef" => "999999191106195503191106195503",
            "originatorNarration" => "Payment from 0112345678 to 1780004070",
            "paymentReference" => "NIPMINI/999999191106195503191106195503/6015007956/0231116887",
            "transactionId" => $transactionId, // Use the generated transactionId
            "transactionLocation" => "1.38716,3.05117",
            "beneficiaryNarration" => "Payment to 0112345678 from 1780004070",
            "billerId" => "ADC19BDC-7D3A-4C00-4F7B-08DA06684F59"
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($requestData), // Convert request data to JSON
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json", // Set content type to JSON
                "Authorization: Bearer " . $token,
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            // Handle the API response
            $responseData = json_decode($response, true); // Convert JSON response to associative array
            // ... process and display the $responseData as needed ...
            
            echo $response;
        }





    }


}
