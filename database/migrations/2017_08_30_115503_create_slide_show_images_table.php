<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlideShowImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slideshow_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->nullable();
            $table->string('filename_en', 50)->nullable();
            $table->string('filename_sr', 50)->nullable();
      	    // $table->string('file_name_sr_thumb', 50)->nullable();
      	    $table->string('filename_hu', 50)->nullable();
      	    // $table->string('file_name_hu_thumb', 50)->nullable();
      	    $table->integer('order_no')->nullable();
      	    $table->string('url_sr', 255)->nullable();
      	    $table->string('url_hu', 255)->nullable();
      	    $table->date('date_off')->nullable();
      	    $table->boolean('online')->default(true);
      	    $table->boolean('type')->default(false);
            $table->string('transition',255)->nullable();
            $table->tinyInteger('slotamount')->nullable();
            $table->string('masterspeed', 255)->nullable();
            $table->integer('delay')->nullable();
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
        Schema::dropIfExists('slideshow_images');
    }
}
