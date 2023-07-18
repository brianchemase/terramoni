<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_agents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 50);
            $table->string('mid_name', 50);
            $table->string('last_name', 50);
            $table->string('dob', 50);
            $table->string('phone', 50);
            $table->string('email', 50);
            $table->string('gender', 50);
            $table->string('location',225);
            $table->string('country', 225);
            $table->string('status', 225);
            $table->string('BVN', 50);
            $table->string('national_id_no', 50);
            $table->string('passport', 225);
            $table->date('registration_date');
            $table->date('validation_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_agents');
    }
};
