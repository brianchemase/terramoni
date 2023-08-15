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

        //$token = "YOUR_TOKEN_HERE"; // Replace with your actual token
        // $token="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImtpZCI6Ii1LSTNROW5OUjdiUm9meG1lWm9YcWJIWkdldyJ9.eyJhdWQiOiJkMDFlMzFhNi1iOTFjLTQ4ZWQtYjYyNS03MzQ3YzUzNTYzYjEiLCJpc3MiOiJodHRwczovL2xvZ2luLm1pY3Jvc29mdG9ubGluZS5jb20vMjc5YzdiMWItYmEwNi00MjdiLWE2ODEtYzhhNTQ5MmQyOTNkL3YyLjAiLCJpYXQiOjE2OTIwODc1NDQsIm5iZiI6MTY5MjA4NzU0NCwiZXhwIjoxNjkyMDkxNDQ0LCJhaW8iOiJBU1FBMi84VUFBQUFESklVaVJjZHFKMCtZWWFwTXBFYzJKZ29sL2FBTHJuMVROT3Zzd2RIbng4PSIsImF6cCI6ImQwMWUzMWE2LWI5MWMtNDhlZC1iNjI1LTczNDdjNTM1NjNiMSIsImF6cGFjciI6IjEiLCJyaCI6IjAuQVlJQUczdWNKd2E2ZTBLbWdjaWxTUzBwUGFZeEh0QWN1ZTFJdGlWelI4VTFZN0dDQUFBLiIsInRpZCI6IjI3OWM3YjFiLWJhMDYtNDI3Yi1hNjgxLWM4YTU0OTJkMjkzZCIsInV0aSI6ImtQMGtqZ2Q0YmtDU2d2a19xQ1VPQUEiLCJ2ZXIiOiIyLjAifQ.T0210QClb-MpZVPfttwjUQ_VR5j9U0m46QGO_WMohUWu14DgG-95XNR98qdrx_HW2b7DtoHxCNz3qnvHKwsxDms2DEF8skSkkHzpVkBRzaVPCGpFYaCMZqnJos-dy4kiti5e7LBiGK_0XoQa0vKdW914H31tNqn_8JXc0pOfDu-rJBJrlWGntkalCfURPSAvoXBPv5ErxlVSfpw_oSnszQrh_xoLSxZ6XborKl-Rm4Ov44YJfEXW1_WupQajKKWZ-HEXjIgBpFsxxrm7p414X1dX7Vw3Z5Lao8UHrwzWmcR6LI12Zv96JZeM8OieABZ8JyWOXqJa2BGI_6N9GW2mNQ";
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
}
