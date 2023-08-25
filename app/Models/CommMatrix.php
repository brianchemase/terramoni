<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommMatrix extends Model
{
    protected  $primaryKey='cr_id' ;

    public $timestamps = false;


    protected $table = 'commission_matrix1'; 

    protected $fillable = [
        'agent_type',
        't_agent_type',
        'agent_tier_level',
        'agent_id',
        'state_id',
        'lga_id',
        'biller_id',
        'transaction_type',
        'customer_segment_id',
        'special_promotion_id',
        'min_trans_amount',
        'max_trans_amount',
        'commission_rate',
        'start_time',
        'end_time',
        'start_date',
        'end_date',
    ];
}
