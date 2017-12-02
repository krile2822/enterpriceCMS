<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id');
            $table->string('storage');
            $table->text('title_en')->nullable();
            $table->text('title_hu')->nullable();
            $table->text('title_sr')->nullable();
            $table->integer('order_no')->nullable();
            $table->string('file_name', 255);
            $table->string('extension', 5);
            $table->boolean('appears_hu')->default('1');
            $table->boolean('appears_en')->default('1');
            $table->boolean('appears_sr')->default('1');
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
        Schema::dropIfExists('media');
    }
}
