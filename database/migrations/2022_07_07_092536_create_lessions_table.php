<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessions', function (Blueprint $table) {
            $table->id();
            $table->string('lession_name');
            $table->unsignedBigInteger('modules_id');
            $table->foreign('modules_id')->references('id')->on('modules')->onDelete('cascade');
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
        Schema::dropIfExists('lessions');
    }
}
