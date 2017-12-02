<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('parent_id')->nullable();
            $table->integer('author_id');
            $table->integer('media_id')->nullable();
            $table->boolean('home_page')->default('0');
            $table->string('module_name', 100)->nullable();
            $table->string('module_menu', 100)->nullable();
            $table->boolean('is_module')->default('0');
            $table->string('title_hu', 255)->nullable();
            $table->string('title_sr', 255)->nullable();
            $table->string('title_en', 255)->nullable();
            $table->text('description_hu')->nullable();
            $table->text('description_sr')->nullable();
            $table->text('description_en')->nullable();
            $table->integer('order_no')->default('99');
            $table->boolean('online')->default('0');
            $table->boolean('appears')->default('0')->comment('appears in navigation menu');
            $table->boolean('protected')->default('0')->comment('lehet-e torolni');
            $table->boolean('articles_nav')->default('0');
            $table->string('url_en', 255)->nullable();
            $table->string('url_sr', 255)->nullable();
            $table->string('url_hu', 255)->nullable();
            $table->date('date_posted');
            $table->string('view', 255)->nullable();
            $table->string('link', 255)->nullable();
            $table->boolean('commentable')->nullable();
            $table->integer('access_level')->nullable();
            $table->integer('admin_access_role')->comment('role id for admin access')->nullable();
            $table->integer('per_page')->nullable();
            $table->boolean('level')->nullable();
            $table->boolean('bc')->default('1');
            $table->boolean('article_ordering')->default('1');
            $table->integer('view_count')->nullable();
            $table->string('page_langs', 4)->default('all');
            $table->boolean('featured');
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
        Schema::dropIfExists('pages');
    }
}
