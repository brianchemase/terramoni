<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $table = 'tbl_agents';

    public function agentType()
    {
        return $this->belongsTo(AgentType::class, 'agent_type');
    }
}
