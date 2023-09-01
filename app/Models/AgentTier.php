<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentTier extends Model
{
    use HasFactory;

    protected $table= 'agent_tier';

    public $timestamps = false;

    protected $primaryKey = 'tier_id';

    protected $fillable = [
        'tier_name',
        'tier_notes',
        
    ];

    
}
