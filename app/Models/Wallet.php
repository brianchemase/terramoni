<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Wallet extends Model
{
    use HasFactory;

    protected $table='wallet';
    protected $primaryKey = 'wallet_id';
    public $timestamps = false;

    protected $fillable=[
        'wallet_id',
        'agent_id',
        'pos_id',
        'wallet_name',
        'wallet_balance',
        'wallet_locked',
        'wallet_active',
        'wallet_code',
        'wallet_crypt',
        'wallet_narrative'

    ];
}
