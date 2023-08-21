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

         //$agent_id = rand(1, 899);
         $agent = DB::table('tbl_agents')
         ->select('first_name', 'last_name')
         ->where('id', $agent_id)
         ->first();

        $agent_names = null;
        if ($agent) {
            $agent_names = $agent->first_name . ' ' . $agent->last_name;
        }

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


            // Store the data into the tbl_transactions table using the DB facade
        DB::table('tbl_transactions')->insert([
            'Name' => "Card Check Balance",
            'BillerName' => $destinationInstitutionCode,
            'ConsumerIdField' => $agent_names,
            'agent_id' => $agent_id,
            'customer_reference' => $transactionId,
            'ItemFee' => "10",//customer_reference
            'CurrencySymbol' => 'NRN',
            'BillerType' => 'Check Balance',
        ]);
           return $response;
        }


    }

    public function fundstransfer(Request $request)
    {

        $request->validate([
            'sourceInstitutionCode' => 'required',
            'originAccNo' => 'required',
            //'originAccName' => 'required',
            'destinationInstitutionCode' => 'required',
            'destAccNo' => 'required',
            //'destAccName' => 'required',
           'agent_id' => 'required',
        ]);

        $sourceInstitutionCode=$request->input('sourceInstitutionCode');
        $originAccNo=$request->input('originAccNo');
        //$originAccName=$request->input('originAccName');
        $destinationInstitutionCode=$request->input('destinationInstitutionCode');
        $destAccNo=$request->input('destAccNo');
        //$destAccName=$request->input('destAccName');
        $agent_id = $request->input('agent_id');

        $apiUrl = "https://apitest.nibss-plc.com.ng/nipservice/v1/nip/fundstransfer";

        $channelCode="1";

        // Generate transactionId
        $clientno = '000306'; // Replace with the actual client number
        $today = date("ymd");
        $time = date("His");
        $randomnumber = str_pad(mt_rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
        $transactionId = $clientno . $today . $time . $randomnumber;
        $token = DB::table('tbl_nibbs_token')->select('token')->orderBy('id', 'desc')->value('token');
        
        $destinationInstitutionCode=$sourceInstitutionCode;
        $accountNumber=$originAccNo;

        $originresponse = $this->sendNameEnquiryRequest($accountNumber, $channelCode, $destinationInstitutionCode);
        //return $originresponse;
        $originresponseData = json_decode($originresponse, true); // Convert JSON to associative array
        $originatorBankVerificationNumber = $originresponseData['bankVerificationNumber'] ?? null;
        $originAccName = $originresponseData['accountName'] ?? null;


        $destinationInstitutionCode=$destinationInstitutionCode;
        $accountNumber=$destAccNo;

        $destinationresponse = $this->sendNameEnquiryRequest($accountNumber, $channelCode, $destinationInstitutionCode);
        //return $destinationresponse;
        $destinationresponseData = json_decode($destinationresponse, true); // Convert JSON to associative array
        $destAccName = $destinationresponseData['accountName'] ?? null;
        $destinationBankVerificationNumber = $destinationresponseData['bankVerificationNumber'] ?? null;
       
      // return $destAccNo;

        // $sourceInstitutionCode="999998";
        // $originAccNo="0112345678";
        // $originAccName="vee Test";
        // $destAccNo="1780004070";
        // $destAccName="Ake Mobolaji Temabo";

        // Prepare the request data
        $requestData = array(
            "sourceInstitutionCode" => $sourceInstitutionCode,
            "amount" => 100,
            "beneficiaryAccountName" => $destAccName,
            "beneficiaryAccountNumber" => $destAccNo,
            "beneficiaryBankVerificationNumber" => $destinationBankVerificationNumber,
            "beneficiaryKYCLevel" => 1,
            "channelCode" => 1,
            "originatorAccountName" => $originAccName,
            "originatorAccountNumber" => $originAccNo,
            "originatorBankVerificationNumber" => $originatorBankVerificationNumber,
            "originatorKYCLevel" => 1,
            "destinationInstitutionCode" => $destinationInstitutionCode,
            "mandateReferenceNumber" => "MA-0112345678-2022315-53097",
            "nameEnquiryRef" => "999999191106195503191106195503",
            "originatorNarration" => "Payment from $originAccNo to $destAccNo",
            "paymentReference" => "NIPMINI/999999191106195503191106195503/6015007956/0231116887",
            "transactionId" => $transactionId, // Use the generated transactionId
            "transactionLocation" => "1.38716,3.05117",
            "beneficiaryNarration" => "Payment to $originAccNo from $destAccNo",
            "billerId" => "ADC19BDC-7D3A-4C00-4F7B-08DA06684F59"
        );

        $agent = DB::table('tbl_agents')
        ->select('first_name', 'last_name')
        ->where('id', $agent_id)
        ->first();

       $agent_names = null;
       if ($agent) {
           $agent_names = $agent->first_name . ' ' . $agent->last_name;
       }

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

            $todayDate = date("Ymd");

            DB::table('tbl_commissions')->insert([
                'transaction_id' => $transactionId,
                'agent_id' => $agent_id,
                'amount' => 0,
                'commission' => 15,
                'date' => $todayDate,
                'type' => 'Debit',
            ]);

            
            // Store the data into the tbl_transactions table using the DB facade
            DB::table('tbl_transactions')->insert([
            'Name' => "Card FT ",
            'BillerName' => $originAccName,
            'ConsumerIdField' => $agent_names,
            'agent_id' => $agent_id,
            'customer_reference' => $transactionId,
            'ItemFee' => "10",//customer_reference
            'CurrencySymbol' => 'NRN',
            'BillerType' => 'Fund Transfer',
        ]);
            
            return $response;
        }


    }

    public function nameEnquiry(Request $request)
    {

        $request->validate([
            'accountNumber' => 'required',
            'channelCode' => 'required',
            'destinationInstitutionCode' => 'required',
            
        ]);

        $accountNumber=$request->input('accountNumber');
        $channelCode=$request->input('channelCode');
        $destinationInstitutionCode=$request->input('destinationInstitutionCode');

        $curl = curl_init();

        // Generate transactionId
        $clientno = '000306'; // Replace with the actual client number
        $today = date("ymd");
        $time = date("His");
        $randomnumber = str_pad(mt_rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
        $transactionId = $clientno . $today . $time . $randomnumber;
        $token = DB::table('tbl_nibbs_token')->select('token')->orderBy('id', 'desc')->value('token');



        $data = array(
            "accountNumber" => $accountNumber,
            "channelCode" => $channelCode,
            "destinationInstitutionCode" => $destinationInstitutionCode,
            "transactionId" => $transactionId // Use the generated transactionId
        );

        $jsonData = json_encode($data);

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://apitest.nibss-plc.com.ng/nipservice/v1/nip/nameenquiry",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $jsonData,
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer ".$token,
            "content-type: application/json"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
       return $response;
        }

    }

    public function sendNameEnquiryRequest($accountNumber, $channelCode, $destinationInstitutionCode)
    {
        $curl = curl_init();

        // Generate transactionId
        $clientno = '000306'; // Replace with the actual client number
        $today = date("ymd");
        $time = date("His");
        $randomnumber = str_pad(mt_rand(0, 999999999999), 12, '0', STR_PAD_LEFT);
        $transactionId = $clientno . $today . $time . $randomnumber;
        $token = DB::table('tbl_nibbs_token')->select('token')->orderBy('id', 'desc')->value('token');

       // return $destinationInstitutionCode;

        $data = array(
            "accountNumber" => $accountNumber,
            "channelCode" => $channelCode,
            "destinationInstitutionCode" => $destinationInstitutionCode,
            "transactionId" => $transactionId // Use the generated transactionId
        );

        $jsonData = json_encode($data);

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apitest.nibss-plc.com.ng/nipservice/v1/nip/nameenquiry",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $jsonData,
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer ".$token,
                "content-type: application/json"
            ),
            ));
    

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }


}
