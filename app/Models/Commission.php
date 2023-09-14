<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $table = 'tbl_commissions';
    protected $fillable = [
        'transaction_id',
        'amount',
        'commission',
        'type',
        'date',
        'agent_id',
    ];
}