<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NibbsController extends Controller
{
    //

    public function getInstitutions()
    {

        $token = "YOUR_TOKEN_HERE"; // Replace with your actual token
         $token="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImtpZCI6Ii1LSTNROW5OUjdiUm9meG1lWm9YcWJIWkdldyJ9.eyJhdWQiOiJkMDFlMzFhNi1iOTFjLTQ4ZWQtYjYyNS03MzQ3YzUzNTYzYjEiLCJpc3MiOiJodHRwczovL2xvZ2luLm1pY3Jvc29mdG9ubGluZS5jb20vMjc5YzdiMWItYmEwNi00MjdiLWE2ODEtYzhhNTQ5MmQyOTNkL3YyLjAiLCJpYXQiOjE2OTIwODU4MDgsIm5iZiI6MTY5MjA4NTgwOCwiZXhwIjoxNjkyMDg5NzA4LCJhaW8iOiJFMkZnWU5DeTN5VFNmUGhKb25qNzMxT3F5OHhmbnEvbE9HK2daTEU1Um5TMStMWm5PdXNBIiwiYXpwIjoiZDAxZTMxYTYtYjkxYy00OGVkLWI2MjUtNzM0N2M1MzU2M2IxIiwiYXpwYWNyIjoiMSIsInJoIjoiMC5BWUlBRzN1Y0p3YTZlMEttZ2NpbFNTMHBQYVl4SHRBY3VlMUl0aVZ6UjhVMVk3R0NBQUEuIiwidGlkIjoiMjc5YzdiMWItYmEwNi00MjdiLWE2ODEtYzhhNTQ5MmQyOTNkIiwidXRpIjoiVF9sbXlCNVBoRXVESExxMGlydE9BQSIsInZlciI6IjIuMCJ9.l6RVgWGdNiRxGsC4qVW1GLrkivwX7vQiy6SjKsd4p8uT03gtjD3i831ZlmD3-yvHKi0y9DJiyD6VyV3vru4AO4x5D4W0o5KA5eZYS5h76K1ThEVZp8mu3dkWnJ-VCHYmCHdUTWSal3wZqXpjWQDlG4yscwQVHIecQhdGiFwD7j8N9637j4ZlhdWEuJyZxwc6DjoMnSeLgrb1khGEFahZ1XlOh1JtdTDKqB-WFu6U3o5UL_e3KG105tHwUvBss-RMEazAak6otEOx-Un7RKtTbbdG3zEQegDa8YUT72QdOh5HR8Zr6KCxNOFXInBQqffqLW21JlVKflvJJRWdN7VCiw";
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
