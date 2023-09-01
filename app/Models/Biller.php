<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biller extends Model
{
    use HasFactory;

    protected $table='biller';
    protected $primaryKey = 'biller_id';
    public $timestamps = false;
    protected $fillable=[
        'biller_cat_id',
        'biller_code',
        'biller_name',
        'biller_url',
        'biller_note',
    ];
}
