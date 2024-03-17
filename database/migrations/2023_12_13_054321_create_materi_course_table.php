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
        Schema::create('materi_course', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->dateTime('star_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('title_materi')->nullable();
            $table->string('status_materi')->nullable();
            $table->text('des_materi')->nullable();
            $table->text('file_materi')->nullable();
            $table->text('link_video')->nullable();
            $table->text('link_meet')->nullable();
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
