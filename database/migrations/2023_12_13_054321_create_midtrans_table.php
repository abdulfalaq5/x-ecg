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
        Schema::create('midtrans', function (Blueprint $table) {
            $table->id();
            $table->string('no_order')->nullable();
            $table->unsignedBigInteger('pengguna_id')->nullable();
            $table->unsignedBigInteger('tagihan_id')->nullable();
            $table->string('is_recurring')->nullable();
            $table->string('cc_token_id')->nullable();
            $table->string('total')->nullable();
            $table->text('midtrans_statement')->nullable();
            $table->string('transaction_status')->nullable();
            $table->string('fraud_status')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_bank')->nullable();
            $table->string('payment_va')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('response')->nullable();
            $table->datetime('payment_at')->nullable();
            $table->datetime('expired_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('midtrans');
    }
};
