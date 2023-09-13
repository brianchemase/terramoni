<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransactionsController extends Controller
{
    //
    public function transactions($agent_id)
    {
         // Perform the database query to fetch the transaction history for the given agent_id
         $transactionHistory = DB::table('tbl_transactions')
         ->where('agent_id', $agent_id)
         ->orderBy('id', 'desc') 
         ->get();

         //$transactionHistory=
         //$transactionHistory['Id'] =$transactionHistory['customer_reference'];

     // Return the JSON response with the results
     return response()->json($transactionHistory);
    }
    public function eodtransactions($agent_id)

    {
        $transaction_date = null;
        // If $transaction_date is not provided, use the current date
        if (is_null($transaction_date)) {
            $transaction_date = Carbon::now()->toDateString();
        } else {
            // Parse and format the provided date as "YYYY-MM-DD"
            $transaction_date = Carbon::parse($transaction_date)->toDateString();
        }
        // Perform the database query to fetch the transaction history for the given agent_id and transaction_date
        $transactionHistory = DB::table('tbl_transactions')
            ->select('transaction_type', DB::raw('SUM(ItemFee) as total'))
            ->where('agent_id', $agent_id)
            ->whereDate('transaction_date', $transaction_date)
            ->groupBy('transaction_type')
            ->get();

        // Initialize an array to store the daily totals
        $dailyTotals = [
            'billpayments' => 0,
            'withdrawals' => 0,
            'transfers' => 0,
        ];

        // Calculate the daily totals for each transaction type
        foreach ($transactionHistory as $transaction) {
            switch ($transaction->transaction_type) {
                case 'billpayment':
                    $dailyTotals['billpayments'] = (int)$transaction->total;
                    break;
                case 'withdrawals':
                    $dailyTotals['withdrawals'] = (int)$transaction->total;
                    break;
                case 'fundtransfer':
                    $dailyTotals['transfers'] = (int)$transaction->total;
                    break;
            }
        }

        // Return the JSON response with the daily totals
        return response()->json($dailyTotals);
    }


    public function agentTransactions(Request $request, $id)
    {


         // Perform the database query to fetch the transaction history for the given agent_id
         $transactionHistory = DB::table('tbl_transactions')
         ->where('agent_id', $id)
         ->orderBy('id', 'desc') 
         ->get();


         $first_name = DB::table('tbl_agents')->where('id', $id)->value('first_name');
         $mid_name = DB::table('tbl_agents')->where('id', $id)->value('mid_name');
         $last_name = DB::table('tbl_agents')->where('id', $id)->value('last_name');



         $data = [
            'first_name' => $first_name,
            'mid_name' => $mid_name,
            'last_name' => $last_name,
            'transactions' => $transactionHistory,
           
        ];

        //return $transactionHistory;
        return view ('agents.agentsTranstable')->with($data);;

      
    }

    public function FullTransactions()
    {


         // Perform the database query to fetch the transaction history for the given agent_id
         $transactionHistory = DB::table('tbl_transactions')
         //->where('agent_id', $id)
         ->orderBy('id', 'desc') 
         ->get();


         $data = [            
            'transactions' => $transactionHistory,
        ];

        //return $transactionHistory;
        return view ('agents.FullTranstable')->with($data);;

      
    }

    public function getTransactions()
    {
        // The API endpoint URL
        $api_url = 'https://clients.primeairtime.com/api/transactions/1';

        // Your bearer token
        $token = DB::table('tbl_prime_token')->select('token')->orderBy('id', 'desc')->value('token');
        $bearer_token = DB::table('tbl_prime_token')->select('token')->orderBy('id', 'desc')->value('token');

        // Initialize cURL session
        $ch = curl_init($api_url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $bearer_token,
        ]);

        // Execute the cURL session
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            // Handle the error, e.g., log it or display an error message
            return 'cURL Error: ' . curl_error($ch);
        }

        // Close the cURL session
        curl_close($ch);

        // Process the API response (if needed)
        // ...

        // Output the API response
       // return $response;
        // Convert the JSON response to an array
        $dataArray = json_decode($response, true);

        // Get the "docs" array from the response data
        $docs = $dataArray['docs'];

       // return view ('agents.table');

        // Pass the $docs array to the view
        return view('agents.transactions', compact('docs'));
    }

    public function retreiveTrans(Request $request, $trans_id)
    {

        $apiUrl = "https:/clients.primeairtime.com/api/topup/log/byref/$trans_id"; // The API endpoint URL
       // return $apiUrl;

        $accessToken = DB::table('tbl_prime_token')->select('token')->orderBy('id', 'desc')->value('token');
       

            // Initialize cURL session
            $ch = curl_init();

            // Set the cURL options
            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $accessToken, // Add the Bearer token to the request headers
            ]);

            // Execute the cURL request
            $response = curl_exec($ch);

            // Check for cURL errors
            if (curl_errno($ch)) {
                echo 'cURL error: ' . curl_error($ch);
            }

            // Close the cURL session
            curl_close($ch);

            echo $response;


    }

        public function retrieveTransReprint($trans_id)
        {
            $apiUrl = "https:/clients.primeairtime.com/api/topup/log/byref/$trans_id"; // The API endpoint URL

            $accessToken = DB::table('tbl_prime_token')->select('token')->orderBy('id', 'desc')->value('token');

            // Initialize cURL session
            $ch = curl_init();

            // Set the cURL options
            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $accessToken, // Add the Bearer token to the request headers
            ]);

            // Execute the cURL request
            $response = curl_exec($ch);

            // Check for cURL errors
            if (curl_errno($ch)) {
                echo 'cURL error: ' . curl_error($ch);
            }

            // Close the cURL session
            curl_close($ch);

            // Decode the JSON response
            $data = json_decode($response, true);
            //return $data;

            if ($data === null) {
                // Handle JSON decoding error
                echo 'Error decoding JSON response';
            } else {
                // Access the values in client_apiresponse
                $clientApiResponse = json_decode($data['client_apiresponse'], true);

                if ($clientApiResponse === null) {
                    // Handle JSON decoding error for client_apiresponse
                    echo 'Error decoding JSON in client_apiresponse';
                } else {
                    // Now you can access the values within client_apiresponse as an associative array
                    $status = $clientApiResponse['status'];
                    $message = $clientApiResponse['message'];
                    // ... and so on
                    // You can use these values as needed in your code

                    return $clientApiResponse;
                }
            }
        }

}

