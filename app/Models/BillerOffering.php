<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biller extends Model
{
    use HasFactory;

    protected $table='biller_offering';
    protected $primaryKey = 'biller_offering_id';
    public $timestamps = false;
    protected $fillable=[
        'biller_id',
        'offering_name',
        'offering_description',
        'offering_price',

        
    ];
}