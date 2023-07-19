<?php

namespace App\Http\Controllers;

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

    $currentDate = Carbon::now();
    $file = $request->file('file');
    $path = $file->getPathname();

//return $path;

   $reader = ReaderEntityFactory::createReaderFromFile($path);
   $reader->open($path);




    $data = [];
    foreach ($reader->getSheetIterator() as $sheet) {
        foreach ($sheet->getRowIterator() as $row) {
            $rowValues = $row->toArray();
            $data[] = [
                'device_name' => $rowValues[0],
                'serial_no' => $rowValues[1],
                'device_os' => $rowValues[2],
                'status' => "available",
                'owner_type' => "Store",
                'registration_date' => $currentDate,
                
                // Add more columns as needed
            ];
        }
    }

    $reader->close();

   // PosTerminal::insert($data);
   DB::table('tbl_pos_terminals')->insert($data);

    return redirect()->back()->with('success', 'Terminals imported successfully!');
    }
}
