<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSegment extends Model
{
    use HasFactory;

    protected $table ='customer_segment';
    public $timestamps = false;

    protected $primaryKey= 'cs_id';
    protected $fillable= [
        'cs_name',	
        'cs_notes',
    ];
}
