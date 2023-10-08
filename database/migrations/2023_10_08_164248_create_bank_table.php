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
        Schema::create('bank', function (Blueprint $table) {
            $table->id('bank_id');
            $table->string('bank_code', 50)->nullable()->comment('NIBSS institutionCode');
            $table->string('bank_name', 255);
            $table->integer('bank_category')->default(2)->comment('category');
            $table->string('swift_code', 50)->nullable()->unique();
            $table->string('sort_code', 50)->nullable()->unique();
            $table->string('iban', 50)->nullable()->unique();
            $table->string('cust_care_phone', 30)->nullable();
            $table->string('cust_care_email', 50)->nullable();
            $table->text('escalation_contact')->nullable();
            $table->timestamp('created_on')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();
            $table->timestamp('updated_on')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank');
    }
};
