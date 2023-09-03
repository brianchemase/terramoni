<?php

namespace App\Http\Controllers;

use App\Imports\PosTerminalsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Common\Type;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PosTerminalController extends Controller
{
    //
    public function import(Request $request)
    {

        // Validate the uploaded file (if needed)
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        // Use the Excel facade to import the data from the file
        Excel::import(new PosTerminalsImport, $file);

        // Optionally, you can return a response or redirect back
        return redirect()->back()->with('success', 'POS Excel file imported successfully into the system.');
    }

    public function updatePOSStatus(Request $request)
    {
        // Validate the form data
    $request->validate([
        'serial_no' => 'required',
        'action' => 'required',
        'comment' => 'nullable',
    ]);

    // Check if the action is "Repossess" and update accordingly
    if ($request->input('action') === 'Repossess') {
        $affectedRows = DB::table('tbl_pos_terminals')
            ->where('serial_no', $request->input('serial_no'))
            ->update([
                'status' => 'available',
                'agent_id' => 'Null',
                'aggregator_id' => 'Null',
                'owner_type' => 'store',
                'comment' => $request->input('comment'), // You can update the comment as well
            ]);
    }
    elseif ($request->input('action') === 'Suspend') {
        $affectedRows = DB::table('tbl_pos_terminals')
            ->where('serial_no', $request->input('serial_no'))
            ->update([
                'status' => 'suspended', // Update status to 'suspended'
                'comment' => $request->input('comment'),
            ]);
    }  
    elseif ($request->input('action') === 'Deactivate') {
        $affectedRows = DB::table('tbl_pos_terminals')
            ->where('serial_no', $request->input('serial_no'))
            ->update([
                'status' => 'Deactivated', // Update status to 'suspended'
                'comment' => $request->input('comment'),
            ]);
    }  
    elseif ($request->input('action') === 'faulty') {
        $affectedRows = DB::table('tbl_pos_terminals')
            ->where('serial_no', $request->input('serial_no'))
            ->update([
                'status' => 'faulty', // Update status to 'suspended'
                'agent_id' => 'Null',
                'aggregator_id' => 'Null',
                'owner_type' => 'store',
                'comment' => $request->input('comment'),
            ]);
    }  
    else {
        // For other actions, update only 'action' and 'comment'
        $affectedRows = DB::table('tbl_pos_terminals')
            ->where('serial_no', $request->input('serial_no'))
            ->update([
                'action' => $request->input('action'),
                'comment' => $request->input('comment'),
            ]);
    }

    if ($affectedRows > 0) {
        // The update was successful
        return redirect()->back()->with('success', 'POS Terminal updated successfully');
    } else {
        // Handle the case when the serial number is not found or not updated
        return redirect()->back()->with('error', 'POS Terminal not found or not updated');
    }
    }
}
