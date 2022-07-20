<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child__categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('main__categories_id');
            $table->foreign('main__categories_id')->references('id')->on('main__categories')->onDelete('cascade');
            $table->unsignedBigInteger('sub__categories_id');
            $table->foreign('sub__categories_id')->references('id')->on('sub__categories')->onDelete('cascade');
            $table->string('child_category');
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
        Schema::dropIfExists('child__categories');
    }
}
