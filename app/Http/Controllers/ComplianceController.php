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
        $yourAccessToken = 'eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICIzaVgtaEFrS3RmNUlsYWhRcElrNWwwbFBRVlNmVnpBdG9WVWQ4UXZ1OHJFIn0.eyJleHAiOjE2OTIwMzE5NjgsImlhdCI6MTY5MjAyNDc2OCwianRpIjoiYThhNDM4NzQtOTRiOC00MjMyLTkwZDQtMzUzYjAwZWYwOTc1IiwiaXNzIjoiaHR0cHM6Ly9hdXRoLnFvcmVpZC5jb20vYXV0aC9yZWFsbXMvcW9yZWlkIiwiYXVkIjpbInFvcmVpZGFwaSIsImFjY291bnQiXSwic3ViIjoiNGM3ZDVjZTUtZTIyMC00NmY4LTlkODgtNDMyZTg1NmFiODQ1IiwidHlwIjoiQmVhcmVyIiwiYXpwIjoiME85VTA3VDY2WEJWWVI1R1dJR08iLCJhY3IiOiIxIiwicmVhbG1fYWNjZXNzIjp7InJvbGVzIjpbIm9mZmxpbmVfYWNjZXNzIiwidW1hX2F1dGhvcml6YXRpb24iLCJkZWZhdWx0LXJvbGVzLXFvcmVpZCJdfSwicmVzb3VyY2VfYWNjZXNzIjp7InFvcmVpZGFwaSI6eyJyb2xlcyI6WyJ2ZXJpZnlfZHJpdmVyc19saWNlbnNlX3N1YiJdfSwiYWNjb3VudCI6eyJyb2xlcyI6WyJtYW5hZ2UtYWNjb3VudCIsIm1hbmFnZS1hY2NvdW50LWxpbmtzIiwidmlldy1wcm9maWxlIl19fSwic2NvcGUiOiJwcm9maWxlIGVtYWlsIiwiZW52aXJvbm1lbnQiOiJzYW5kYm94Iiwib3JnYW5pc2F0aW9uSWQiOjIwNjQyMywiY2xpZW50SG9zdCI6IjE5Mi4xNjguMTkzLjE0MCIsImNsaWVudElkIjoiME85VTA3VDY2WEJWWVI1R1dJR08iLCJlbWFpbF92ZXJpZmllZCI6ZmFsc2UsInByZWZlcnJlZF91c2VybmFtZSI6InNlcnZpY2UtYWNjb3VudC0wbzl1MDd0NjZ4YnZ5cjVnd2lnbyIsImFwcGxpY2F0aW9uSWQiOjE1Mzc5LCJjbGllbnRBZGRyZXNzIjoiMTkyLjE2OC4xOTMuMTQwIn0.OpLKyn5NO1uL0WoeKvAh3eibzqmERFQNYq2hxB3MLDpKlEN4O4fETwv1TaPoT-wXu-RLO2c3e6iO20bU3D3H6VMfkUSqCyY_BEEWRTNXpmxq61xZhzIiVr5_3qMH034j4oNvOGPdirJOKHKnY4RiO6o7Dup5Piyo1KEmf9g30S2kCPXLoH15BcXzZR5k2oOnwrn6d3IZbe_pdWjeHVQn_j0fOhRswO6MoHQtH68HHBv2_d9hd2x6uhuIHOhKr81lflMhrwHl4QBQPN1t7bCpZMei85XLRCwFIQSA5A1Z169uM4KmTq3EJyy8RXo-WxpQYWgexHgjtynBsbfLfwI9WA'; // Replace with your actual token

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
        $doc_no = DB::table('tbl_agents')->where('id', $id)->value('doc_no');
        $doc_type = DB::table('tbl_agents')->where('id', $id)->value('doc_type');
        $location = DB::table('tbl_agents')->where('id', $id)->value('location');
        $country = DB::table('tbl_agents')->where('id', $id)->value('country');
        $email = DB::table('tbl_agents')->where('id', $id)->value('email');
        $phone = DB::table('tbl_agents')->where('id', $id)->value('phone');
        $passport = DB::table('tbl_agents')->where('id', $id)->value('passport');
        $address_proff = DB::table('tbl_agents')->where('id', $id)->value('address_proff');
        
        
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');

        $id_type=$doc_type;

        if($id_type="DL")//DL Function
        {
            $licenseNumber = '63184876213'; // Static license number
            $url = "https://api.qoreid.com/v1/ng/identities/drivers-license/$licenseNumber";

            $data = [
                'firstname' => $firstname,
                'lastname' => $lastname,
            ];

            $response = $this->sendRequest($url, 'post', $data);

            return $response;

            $data = json_decode($response, true);

            if ($data !== null) {
                // Access different fields in the JSON data
                $applicantFirstName = $data['applicant']['firstname'];
                $applicantLastName = $data['applicant']['lastname'];
                $status = $data['summary']['drivers_license_check']['status'];
                $driversLicenseNumber = $data['drivers_license']['driversLicense'];
                $v_firstname = $data['drivers_license']['firstname'];
                $v_lastname = $data['drivers_license']['lastname'];
                $v_middlename = $data['drivers_license']['middlename'];

                $v_dob = $data['drivers_license']['birthdate'];
                $ppt = $data['drivers_license']['photo'];
                $v_issued_date = $data['drivers_license']['issued_date'];
                $v_expiry_date = $data['drivers_license']['expiry_date'];
            
               
            
                // Access and use other fields as needed
            } else {
                echo "Failed to decode JSON data.";
            }

        }
        elseif($id_type="NIN")
        {
            $nin_number = '18482561982';
            $url = "https://api.qoreid.com/v1/ng/identities/nin/$nin_number";

            $data = [
                'firstname' => $firstname,
                'lastname' => $lastname,
            ];

            $response = $this->sendRequest($url, 'post', $data);

            return $response;

        }
        elseif($id_type="passport")
        {
            $passport="";
            $url = "https://api.qoreid.com/v1/ng/identities/passport/$passport";

            $data = [
                'firstname' => $firstname,
                'lastname' => $lastname,
            ];

            $response = $this->sendRequest($url, 'post', $data);

            return $response;
            
        }
        elseif($id_type="voters_card")
        {

            $url = "https://api.qoreid.com/v1/ng/identities/drivers-license/$licenseNumber";

            $data = [
                'firstname' => $firstname,
                'lastname' => $lastname,
            ];

            $response = $this->sendRequest($url, 'post', $data);

            return $response;
            
        }
        else
        {
            $bvn="";
            $url = "https://api.qoreid.com/v1/ng/identities/bvn-basic/$bvn";

            $data = [
                'firstname' => $firstname,
                'lastname' => $lastname,
            ];

            $response = $this->sendRequest($url, 'post', $data);

            return $response;
            
        }


        $data = [
            'first_name' => $first_name,
            'mid_name' => $mid_name,
            'last_name' => $last_name,
            'gender' => $gender,
            'phone' => $phone,
            'status' => $status,
            'BVN' => $BVN,
            'doc_no' => $doc_no,
            'doc_type' => $doc_type,
            'location' => $location,
            'country' => $country,
            'email' => $email, 
            'passport' => $passport, 
            'address_proff' => $address_proff,
            'agent_id' => $id,         
        ];
        

        return view ('agents.agentscomplianceform')->with($data);

    }

    $agents = DB::table('tbl_agents')
            ->where('status', '!=', 'approved')
            ->get();


       // return $agents;
        return view ('agents.pendingagentstable', compact('agents'));
    }
}
