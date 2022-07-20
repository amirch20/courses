<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site__settings', function (Blueprint $table) {
            $table->id();
            $table->string('banner_title');
            $table->string('banner_sub_title');
            $table->enum('cookie_status',['enable','inactive']);
            $table->longText('cookie_note')->nullable()->default('text');
            $table->longText('cookie_policy')->nullable()->default('text');
            $table->longText('about_us')->nullable()->default('text');
            $table->longText('term_and_condition')->nullable()->default('text');
            $table->longText('privacy_policy')->nullable()->default('text');
            $table->string('banner_images');
            $table->string('small_logo');
            $table->string('orignal_logo');
            $table->string('favicon');
            $table->datetime('deleted_at')->nullabe();
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
        Schema::dropIfExists('site__settings');
    }
}
