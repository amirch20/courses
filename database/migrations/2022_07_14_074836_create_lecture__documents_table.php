<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLectureDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecture__documents', function (Blueprint $table) {
            $table->id();
            $table->string('document_title');
            $table->longText('document_description')->nullable()->default('text');
            $table->string('document_file');
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
        Schema::dropIfExists('lecture__documents');
    }
}
