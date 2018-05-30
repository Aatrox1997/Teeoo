<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('content_id')->unsigned()->comment('外键');
            $table->integer('parent')->nullable()->comment('父评论id');
            $table->integer('is_blog')->default(0)->comment('是否是博主回复：0不是,1是');
//            $table->string('parent_name')->comment('父评论标题');
            $table->string('username')->comment('评论者用户名');
            $table->string('email')->comment('评论者邮箱');
            $table->string('url')->nullable()->comment('评论者博客地址');
            $table->text('content')->comment('评论内容');
            $table->foreign('content_id')
                ->references('id')
                ->on('content')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('comments_closure', function (Blueprint $table) {
            $table->unsignedInteger('ancestor');
            $table->unsignedInteger('descendant');
            $table->unsignedTinyInteger('distance');
            $table->primary(['ancestor', 'descendant']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
