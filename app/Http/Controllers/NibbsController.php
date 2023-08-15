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
}
