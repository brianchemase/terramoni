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
        Schema::create('commission_matrix', function (Blueprint $table) {
            $table->id();
            $table->string('tran_type');
            $table->unsignedBigInteger('agent');
            $table->decimal('commission_day', 10, 2);
            $table->decimal('commission_night', 10, 2);
            $table->decimal('min_value', 10, 2);
            $table->decimal('max_value', 10, 2);
            $table->boolean('in_use')->default(true);
            $table->unsignedBigInteger('captured_by');
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
        Schema::dropIfExists('commission_matrix');
    }
};
