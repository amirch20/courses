<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('surname');
            $table->string('nationality');
            $table->string('country');
            $table->string('email');
            $table->string('password');
            $table->string('confirm_password');
            $table->string('last_qualification');
            $table->string('graduation_year');
            $table->string('institution_name');
            $table->string('qualification_country');
            $table->string('upload_transcript');
            $table->string('date_of_birth');
            $table->string('gender');
            $table->string('phone_number');
            $table->string('alternative_phone_number');
            $table->string('address');
            $table->string('current_address');
            $table->longText('additional_information')->nullable()->default('text');
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
        Schema::dropIfExists('admins');
    }
}
