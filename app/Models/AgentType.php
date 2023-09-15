<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentType extends Model
{
    use HasFactory;

    protected $table = 'agent_type';

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];


    public function agents()
    {
        return $this->hasMany(Agent::class, 'agent_type');
    }

}
