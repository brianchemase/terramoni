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
}
