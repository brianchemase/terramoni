<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    use HasFactory;

    protected $table ='trans_type';
    public $timestamps = false;

    protected $primaryKey='tt_id';
    protected $fillable=[
        'tt_name',
        'tt_notes',
    ];
}
