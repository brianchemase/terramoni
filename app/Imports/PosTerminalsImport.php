<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\PosTerminal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PosTerminalsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $currentDate = Carbon::now();
        return new PosTerminal([
            //
            'device_name' => $row['device_name'],
            'serial_no'  => $row['serial_no'],
            'device_model' => $row['device_model'],
            'imei' => $row['imei'],
            'mac_addr'=> $row['mac_addr'],
            'device_make'=> $row['device_make'],
            'device_mfg'=> $row['device_mfg'],
            'os_version'=> $row['os_version'],
            'status' => 'available',
            'owner_type' => 'store', 
            'registration_date' => $currentDate, 
        ]);
    }
}
