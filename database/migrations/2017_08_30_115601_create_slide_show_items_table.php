<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlideShowItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slide_show_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('slide_show_image_id');
            $table->string('text_en', 255)->nullable();
            $table->string('text_sr', 255)->nullable();
            $table->string('text_hu', 255)->nullable();
            $table->integer('image')->nullable();
            $table->string('class', 50)->nullable();
            $table->integer('x')->nullable();
            $table->integer('y')->nullable();
            $table->integer('speed')->nullable();
            $table->integer('start')->nullable();
            $table->string('easing', 20)->nullable();
            $table->string('image_alt', 200)->nullable();
            $table->integer('image_height')->nullable();
            $table->integer('image_width')->nullable();
            $table->string('href_sr', 255)->nullable();
            $table->string('href_hu', 255)->nullable();
            $table->string('href_en', 255)->nullable();
            $table->integer('hoffset')->nullable();
            $table->integer('voffset')->nullable();
            $table->string('splitin',5)->nullable();
            $table->string('filename', 100)->nullable();
            $table->boolean('type')->default('1');
            $table->string('endeasing', 255)->nullable();
            $table->string('endspeed', 255)->nullable();
            $table->string('customin', 255)->nullable();
            $table->string('customout', 255)->nullable();
            $table->tinyInteger('depth')->nullable();
            $table->boolean('online')->default('1');
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
        Schema::dropIfExists('slide_show_items');
    }
}
