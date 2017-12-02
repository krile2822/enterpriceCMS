<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('user_id');
            $table->integer('last_editor_id')->nullable();
            $table->integer('media_id')->nullable();
            $table->string('name', 255)->nullable();
            $table->string('title_hu', 255)->nullable();
            $table->string('title_sr', 255)->nullable();
            $table->string('title_en', 255)->nullable();
            $table->string('subtitle_hu', 255)->nullable();
            $table->string('subtitle_sr', 255)->nullable();
            $table->string('subtitle_en', 255)->nullable();
            $table->longText('content_en')->nullable();
            $table->longText('content_hu')->nullable();
            $table->longText('content_sr')->nullable();
            $table->text('description_hu')->nullable();
            $table->text('description_sr')->nullable();
            $table->text('description_en')->nullable();
            $table->string('url_en', 255)->nullable();
            $table->string('url_hu', 255)->nullable();
            $table->string('url_sr', 255)->nullable();
            $table->date('date_posted')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->boolean('archive')->default(false);
            $table->string('view', 255)->nullable();
            $table->boolean('commentable')->nullable();
            $table->boolean('sharethis')->default('0');
            $table->integer('order_no')->defualt('99');
            $table->string('author_hu', 255)->nullable();
            $table->string('author_sr', 255)->nullable();
            $table->string('author_en', 255)->nullable();
            $table->integer('view_count')->nullable();
            $table->timestamps();
        });

        // set autoincrement to 1000
        DB::update("ALTER TABLE articles AUTO_INCREMENT = 455;");

        Schema::create('article_page', function (Blueprint $table) {
            $table->integer('page_id');
            $table->integer('article_id');
            $table->boolean('published')->default(false);
            $table->primary(['page_id', 'article_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
