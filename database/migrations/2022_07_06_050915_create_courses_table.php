<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_title');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('subjects_id');
            $table->foreign('subjects_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->string('instructor');
            $table->string('short_description');
            $table->longText('description')->nullable()->default('text');
            $table->enum('level', ['beginner', 'middle', 'professional']);
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->longText('requirements')->nullable()->default('text');
            $table->longText('outcomes')->nullable()->default('text');
            $table->double('price');
            $table->boolean('discount_price')->defined(0,1);
            $table->enum('course_privacy', ['public', 'private']);
            $table->string('thumbnail');
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
        Schema::dropIfExists('courses');
    }
}
