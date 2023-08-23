<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ComplianceController extends Controller
{
    //
    private function sendRequest($url, $method, $data = [])
    {
       // $yourAccessToken = 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICIzaVgtaEFrS3RmNUlsYWhRcElrNWwwbFBRVlNmVnpBdG9WVWQ4UXZ1OHJFIn0.eyJleHAiOjE2OTIwNDAzNTEsImlhdCI6MTY5MjAzMzE1MSwianRpIjoiZDc5NTFiMDktZDYyYi00ZTE3LWFhNzctZmYyMDEwNjFkY2JlIiwiaXNzIjoiaHR0cHM6Ly9hdXRoLnFvcmVpZC5jb20vYXV0aC9yZWFsbXMvcW9yZWlkIiwiYXVkIjpbInFvcmVpZGFwaSIsImFjY291bnQiXSwic3ViIjoiNGM3ZDVjZTUtZTIyMC00NmY4LTlkODgtNDMyZTg1NmFiODQ1IiwidHlwIjoiQmVhcmVyIiwiYXpwIjoiME85VTA3VDY2WEJWWVI1R1dJR08iLCJhY3IiOiIxIiwicmVhbG1fYWNjZXNzIjp7InJvbGVzIjpbIm9mZmxpbmVfYWNjZXNzIiwidW1hX2F1dGhvcml6YXRpb24iLCJkZWZhdWx0LXJvbGVzLXFvcmVpZCJdfSwicmVzb3VyY2VfYWNjZXNzIjp7InFvcmVpZGFwaSI6eyJyb2xlcyI6WyJ2ZXJpZnlfdmluX3N1YiIsInZlcmlmeV92aXJ0dWFsX25pbl9zdWIiLCJ2ZXJpZnlfZHJpdmVyc19saWNlbnNlX3N1YiIsInZlcmlmeV9uaW5fc3ViIl19LCJhY2NvdW50Ijp7InJvbGVzIjpbIm1hbmFnZS1hY2NvdW50IiwibWFuYWdlLWFjY291bnQtbGlua3MiLCJ2aWV3LXByb2ZpbGUiXX19LCJzY29wZSI6InByb2ZpbGUgZW1haWwiLCJlbnZpcm9ubWVudCI6InNhbmRib3giLCJvcmdhbmlzYXRpb25JZCI6MjA2NDIzLCJjbGllbnRIb3N0IjoiMTkyLjE2OC4yMjMuMjU1IiwiY2xpZW50SWQiOiIwTzlVMDdUNjZYQlZZUjVHV0lHTyIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwicHJlZmVycmVkX3VzZXJuYW1lIjoic2VydmljZS1hY2NvdW50LTBvOXUwN3Q2NnhidnlyNWd3aWdvIiwiYXBwbGljYXRpb25JZCI6MTUzNzksImNsaWVudEFkZHJlc3MiOiIxOTIuMTY4LjIyMy4yNTUifQ.PJ9vXx9XhEFBAHqhJCne3nxS9U8bSuxcGOYeyjHdLEgY4cBUwqm_SxcYkona-eokF4zdt7ggiOGDp_zim5Ih6LMQqi5cTICRq1A5RMj7nf8sZubiTb5T3ZR0MDNL_r9c1J4m4a_wyyVxD3PH8e9oVRFPaMudqNK9WsykIOs3pX0kamb8PvkNroom3VgL8TI8YIFpRzab5XF6vIiA0Z4bJa5ojdq1A-lDEIfRK11fExgjh6Gsnr7biFmCZXjj9J7AjrkQpp7qksOtQrH6WWMAsGcJxAYmI6IAvbUi7raAWyEVuPvTpruukzmbdE5BgRzF4N7okoTiBXgGS6zw_Zmirg'; // Replace with your actual token
        $yourAccessToken = DB::table('tbl_qoreid_token')->select('token')->orderBy('id', 'desc')->value('token');
        $defaultHeaders = [
            'accept' => 'application/json',
            'authorization' => 'Bearer ' . $yourAccessToken,
            'content-type' => 'application/json',
        ];

        $response = Http::withHeaders($defaultHeaders)->{$method}($url, $data);

        return $response->body();
    }

    public function queryIdentity(Request $request, $id)
    {
        
        $status = DB::table('tbl_agents')->where('id', $id)->value('status');
        if ($status && $status !== 'active') {
            // Call your function here

        $first_name = DB::table('tbl_agents')->where('id', $id)->value('first_name');
        $mid_name = DB::table('tbl_agents')->where('id', $id)->value('mid_name');
        $last_name = DB::table('tbl_agents')->where('id', $id)->value('last_name');
        $gender = DB::table('tbl_agents')->where('id', $id)->value('gender');
        $status = DB::table('tbl_agents')->where('id', $id)->value('status');
        $BVN = DB::table('tbl_agents')->where('id', $id)->value('BVN');
        $dob_db = DB::table('tbl_agents')->where('id', $id)->value('dob');
        $doc_no = DB::table('tbl_agents')->where('id', $id)->value('doc_no');
        $doc_type = DB::table('tbl_agents')->where('id', $id)->value('doc_type');
        $location = DB::table('tbl_agents')->where('id', $id)->value('location');
        $country = DB::table('tbl_agents')->where('id', $id)->value('country');
        $email = DB::table('tbl_agents')->where('id', $id)->value('email');
        $phone = DB::table('tbl_agents')->where('id', $id)->value('phone');
        $passport = DB::table('tbl_agents')->where('id', $id)->value('passport');
        $address_proff = DB::table('tbl_agents')->where('id', $id)->value('address_proff');
        $id_image = DB::table('tbl_agents')->where('id', $id)->value('docimage');

       // return $address_proff;
        
        
        $firstname = $first_name;
        $lastname = $last_name;

        $id_type=$doc_type;

        //return $id_type;


        if($id_type=="DL")//DL Function
        {
            $licenseNumber = $doc_no; // Static license number
            $url = "https://api.qoreid.com/v1/ng/identities/drivers-license/$licenseNumber";

            $data = [
                'firstname' => $firstname,
                'lastname' => $lastname,
            ];

            $response = $this->sendRequest($url, 'post', $data);

          // return $response;

            $data = json_decode($response, true);
            if ($data && isset($data['status']) && $data['status'] === 404 ) 
            {
                    $applicantFirstName="Null";
                    $applicantLastName="Null";
                    $status="Null";
                    $respid="Null";
                    $v_firstname="Null";
                    $v_lastname="Null";
                    $v_middlename="Null";
                    $v_dob="Null";
                    $ppt="Null";

            } 
            else
            {
                // Access different fields in the JSON data
                $applicantFirstName = $data['applicant']['firstname'];
                $applicantLastName = $data['applicant']['lastname'];
                $status = $data['summary']['drivers_license_check']['status'];
                $respid = $data['drivers_license']['driversLicense'];
                $v_firstname = $data['drivers_license']['firstname'];
                $v_lastname = $data['drivers_license']['lastname'];
                $v_middlename = $data['drivers_license']['middlename'];

                $v_dob = $data['drivers_license']['birthdate'];
                $ppt = $data['drivers_license']['photo'];
                $v_issued_date = $data['drivers_license']['issued_date'];
                $v_expiry_date = $data['drivers_license']['expiry_date'];


                $data = [
                    'respfirst' => $applicantFirstName,
                    'resplast' => $applicantLastName,
                    'respstatus' => $status,
                    'respid' => $driversLicenseNumber,
                    'respninfirst' => $v_firstname,
                    'respninlast' => $v_lastname,
                    'respninmid' => $v_middlename,
                    'respnindob' => $v_dob,
                    'respninphoto' => $ppt,
                    //'respninaddress' => $v_address,
                    //'respninlga' => $v_lga,
                    //'respninstate' => $v_state,
                ];

              
            
               
            
                // Access and use other fields as needed
            }

        }
        elseif($id_type=="NIN")
        {
            $nin_number = $doc_no;
            $url = "https://api.qoreid.com/v1/ng/identities/nin/$nin_number";

            $data = [
                'firstname' => $firstname,
                'lastname' => $lastname,
            ];

            $response = $this->sendRequest($url, 'post', $data);

            //return $response;
            $data = json_decode($response, true);

           //return $data;

            if ($data && isset($data['status']) && $data['status'] === 404) 
            {
                    $applicantFirstName="Null";
                    $applicantLastName="Null";
                    $status="Null";
                    $respid="Null";
                    $v_firstname="Null";
                    $v_lastname="Null";
                    $v_middlename="Null";
                    $v_dob="Null";
                    $ppt="Null";

            } 
            else {
                // Access different fields in the JSON data
                $applicantFirstName = $data['applicant']['firstname'];
                $applicantLastName = $data['applicant']['lastname'];
                $status = $data['summary']['nin_check']['status'];
                $respid = $data['nin']['nin'];
                $v_firstname = $data['nin']['firstname'];
                $v_lastname = $data['nin']['lastname'];
                $v_middlename = $data['nin']['middlename'];

                $v_dob = $data['nin']['birthdate'];
                $ppt = $data['nin']['photo'];
                $v_address= $data['nin']['residence']['address1'];
                $v_lga= $data['nin']['residence']['lga'];
                $v_state= $data['nin']['residence']['state'];

               // return $state." ".$lga." ".$address;

               
            
                // Access and use other fields as needed
            }

        }
        elseif($id_type=="passport")
        {
            $passport="";
            $url = "https://api.qoreid.com/v1/ng/identities/passport/$passport";

            $data = [
                'firstname' => $firstname,
                'lastname' => $lastname,
            ];

            $response = $this->sendRequest($url, 'post', $data);
            $data = json_decode($response, true);

            if ($data && isset($data['status']) && $data['status'] === 404) 
            {
                    $applicantFirstName="Null";
                    $applicantLastName="Null";
                    $status="Null";
                    $respid="Null";
                    $v_firstname="Null";
                    $v_lastname="Null";
                    $v_middlename="Null";
                    $v_dob="Null";
                    $ppt="Null";

            } else {

                $applicantFirstName="Null";
                    $applicantLastName="Null";
                    $status="Null";
                    $respid="Null";
                    $v_firstname="Null";
                    $v_lastname="Null";
                    $v_middlename="Null";
                    $v_dob="Null";
                    $ppt="Null";
            }

            //return $response;
            
        }
        elseif($id_type=="voters_card")
        {

            $url = "https://api.qoreid.com/v1/ng/identities/drivers-license/$licenseNumber";

            $data = [
                'firstname' => $firstname,
                'lastname' => $lastname,
            ];

            $response = $this->sendRequest($url, 'post', $data);
            $data = json_decode($response, true);

            //return $response;

            if ($data && isset($data['status']) && $data['status'] === 404) 
            {
                    $applicantFirstName="Null";
                    $applicantLastName="Null";
                    $status="Null";
                    $respid="Null";
                    $v_firstname="Null";
                    $v_lastname="Null";
                    $v_middlename="Null";
                    $v_dob="Null";
                    $ppt="Null";

            } else {

                $applicantFirstName="Null";
                    $applicantLastName="Null";
                    $status="Null";
                    $respid="Null";
                    $v_firstname="Null";
                    $v_lastname="Null";
                    $v_middlename="Null";
                    $v_dob="Null";
                    $ppt="Null";
            }
            
        }
        else
        {
            $bvn=$BVN;
            $url = "https://api.qoreid.com/v1/ng/identities/bvn-basic/$bvn";

            $data = [
                'firstname' => $firstname,
                'lastname' => $lastname,
            ];

            $response = $this->sendRequest($url, 'post', $data);

           // return $response;
                 $applicantFirstName="Null";
                    $applicantLastName="Null";
                    $status="Null";
                    $respid="Null";
                    $v_firstname="Null";
                    $v_lastname="Null";
                    $v_middlename="Null";
                    $v_dob="Null";
                    $ppt="Null";
            
        }


        $data = [
            'first_name' => $first_name,
            'mid_name' => $mid_name,
            'last_name' => $last_name,
            'gender' => $gender,
            'phone' => $phone,
            'dob' => $dob_db,
            'status' => $status,
            'BVN' => $BVN,
            'doc_no' => $doc_no,
            'doc_type' => $doc_type,
            'location' => $location,
            'country' => $country,
            'email' => $email, 
            'passport' => $passport, 
            'address_proff' => $address_proff,
            'doc_image' => $id_image,
            'agent_id' => $id,  
            // from responce
                    'respfirst' => $applicantFirstName,
                    'resplast' => $applicantLastName,
                    'respstatus' => $status,
                    'respid' => $respid,
                    'respninfirst' => $v_firstname,
                    'respninlast' => $v_lastname,
                    'respninmid' => $v_middlename,
                    'respnindob' => $v_dob,
                    'respninphoto' => $ppt,
        ];
       // return $data; 

        return view ('agents.agentscomplianceform')->with($data);

    }

    $agents = DB::table('tbl_agents')
            ->where('status', '!=', 'approved')
            ->get();


       // return $agents;
        return view ('agents.pendingagentstable', compact('agents'));
    }
}
