<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLectureImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecture__images', function (Blueprint $table) {
            $table->id();
            $table->string('image_title');
            $table->longText('image_description')->nullable()->default('text');
            $table->string('image_file');
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
        Schema::dropIfExists('lecture__images');
    }
}
