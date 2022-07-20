<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultipleChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multiple__choices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('text_homeworks_id');
            $table->foreign('text_homeworks_id')->references('id')->on('text_homeworks')->onDelete('cascade');
            $table->longText('type_question')->nullable()->default('text');
            $table->string('number_of_options');
            $table->string('option_1');
            $table->string('option_2');
            $table->string('option_3');
            $table->string('option_4');
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
        Schema::dropIfExists('multiple__choices');
    }
}
