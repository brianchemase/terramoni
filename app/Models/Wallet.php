<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Wallet extends Model
{
    use HasFactory;

    protected $table='wallet';

    protected $primaryKey = 'wallet_id';
    public $timestamps = false;


    public static function updateBalance($walletId, $newBalance)
    {
        DB::table('wallets')
            ->where('wallet_id', $walletId)
            ->update(['wallet_balance' => $newBalance]);
    }
}
