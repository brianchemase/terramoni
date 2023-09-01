<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentTypesTable extends Migration
{
    public function up()
    {
        Schema::create('agent_type', function (Blueprint $table) {
            $table->id(); // Creates an auto-incrementing 'id' column
            $table->string('name');
            // Add other columns as needed
        });
    }

    public function down()
    {
        Schema::dropIfExists('agent_type');
    }
}
