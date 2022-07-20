<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextHomeworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_homeworks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('add_homeworks_id');
            $table->foreign('add_homeworks_id')->references('id')->on('add_homeworks')->onDelete('cascade');
            $table->longText('add_question_text')->nullable()->default('text');
            $table->enum('question_type',['multiple_choice','text']);
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
        Schema::dropIfExists('text_homeworks');
    }
}
