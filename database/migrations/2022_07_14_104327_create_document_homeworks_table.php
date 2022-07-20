<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentHomeworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_homeworks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('add_homeworks_id');
            $table->foreign('add_homeworks_id')->references('id')->on('add_homeworks')->onDelete('cascade');
            $table->string('document_title');
            $table->longText('document_description')->nullable()->default('text');
            $table->string('document_file');
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
        Schema::dropIfExists('document_homeworks');
    }
}
