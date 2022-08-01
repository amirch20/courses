<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course__videos', function (Blueprint $table) {
            $table->id();
            $table->string('video_title');
            $table->longText('video_description')->nullable()->default('text');
            $table->string('video_url');
            $table->unsignedBigInteger('lessions_id');
            $table->foreign('lessions_id')->references('id')->on('lessions')->onDelete('cascade');
            $table->string('lecture_type');
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
        Schema::dropIfExists('course__videos');
    }
}
