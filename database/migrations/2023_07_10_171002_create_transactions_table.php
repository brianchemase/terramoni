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
        Schema::create('tbl_transactions', function (Blueprint $table) {
            $table->string('Id', 10);
            $table->string('Name', 255);
            $table->string('BillerName', 255);
            $table->string('ConsumerIdField', 255);
            $table->string('Code', 10);
            $table->string('BillerType', 10);
            $table->string('ItemFee', 10);
            $table->string('Amount', 10);
            $table->string('BillerId', 10);
            $table->string('BillerCategoryId', 10);
            $table->string('CurrencyCode', 10);
            $table->string('CurrencySymbol', 10);
            $table->string('ItemCurrencySymbol', 10)->nullable();
            $table->boolean('IsAmountFixed');
            $table->integer('SortOrder');
            $table->integer('PictureId');
            $table->string('PaymentCode', 10);
            $table->string('UssdShortCode', 255);
            $table->integer('AmountType');
            $table->string('PaydirectItemCode', 10);
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
        Schema::dropIfExists('tbl_transactions');
    }
};
