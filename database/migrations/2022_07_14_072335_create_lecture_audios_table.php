<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLectureAudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecture_audios', function (Blueprint $table) {
            $table->id();
            $table->string('audio_title');
            $table->longText('audio_description')->nullable()->default('text');
            $table->string('audio_file');
            $table->string('lecture_type');
            $table->unsignedBigInteger('lessions_id');
            $table->foreign('lessions_id')->references('id')->on('lessions')->onDelete('cascade');
            $table->datetime('deleted_at')->nullable();
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
        Schema::dropIfExists('lecture_audios');
    }
}
