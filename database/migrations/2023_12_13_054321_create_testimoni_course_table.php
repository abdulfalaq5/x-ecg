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
        Schema::create('testimoni_course', function (Blueprint $table) {
            $table->id();
            $table->string('pengguna_id')->nullable();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->string('nilai')->nullable();
            $table->string('des')->nullable();
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
        Schema::dropIfExists('testimoni_course');
    }
};
