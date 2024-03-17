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
        Schema::create('course', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->unsignedBigInteger('klasifikasi_id')->nullable();
            $table->string('code')->nullable();
            $table->string('instruktur')->nullable();
            $table->string('waktu_per_minggu')->nullable();
            $table->string('status')->nullable();
            $table->string('live')->nullable();
            $table->string('title')->nullable();
            $table->string('harga')->nullable();
            $table->text('des')->nullable();
            $table->text('cover')->nullable();
            $table->text('income')->nullable();
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
        Schema::dropIfExists('course');
    }
};
