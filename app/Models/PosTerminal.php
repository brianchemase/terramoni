<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosTerminal extends Model
{
    
    use HasFactory;
    protected $table = 'tbl_pos_terminals';
    protected $fillable = ['device_name', 'serial_no', 'device_os','status','owner_type','registration_date'];
    public $timestamps = false;
}
