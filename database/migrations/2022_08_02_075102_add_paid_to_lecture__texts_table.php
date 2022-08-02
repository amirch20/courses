<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaidToLectureTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lecture__texts', function (Blueprint $table) {
            $table->unsignedBigInteger('lessions_id');
            $table->foreign('lessions_id')->references('id')->on('lessions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lecture__texts', function (Blueprint $table) {
            $table->unsignedBigInteger('lessions_id');
            $table->foreign('lessions_id')->references('id')->on('lessions')->onDelete('cascade');
        });
    }
}
