<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotion'; 

    public $timestamps= false;
    protected $primaryKey = 'promo_id'; 

    protected $fillable = [
        'promo_name',
        'promo_notes',
        'promo_start_date',
        'promo_end_date',
        
    ];
}
