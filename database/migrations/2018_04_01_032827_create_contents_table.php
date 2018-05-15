<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('metas_id')->unsigned()->comment('分类');
            $table->foreign('metas_id')->references('id')->on('metas');
            $table->string('title')->nullable()->default('默认标题')->comment('标题');
            $table->string('slug')->nullable()->comment('别名');
            $table->string('cover')->nullable()->comment('封面');
            $table->string('summary')->nullable()->comment('概要');
            $table->text('text')->nullable()->comment('内容');
            $table->text('html')->nullable()->comment('解析内容');
            $table->integer('view_count')->default(0)->unsigned()->comment('浏览次数');
            $table->integer('favorite_count')->nullable()->unsigned()->comment('点赞次数');
            $table->integer('order')->default(0)->comment('排序');
            $table->integer('user_id')->unsigned()->comment('作者');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('types')->default('')->comment('types:{"1":"文章","2":"页面","3":"说说"}');
            $table->string('criticism')->default('1')->comment('criticism:{"1":"允许评论","2":"不允许评论"}');
            $table->string('template')->default('')->comment('模板');
            $table->string('status')->default('publish')->comment('status:{"publish":"公开","hidden":"隐藏","password":"密码保护","private":"私有","waiting":"待审核"}');
            $table->string('pwd')->default('')->nullable()->comment('密码');
            $table->string('quote')->default('')->nullable()->comment('引用通告');
            $table->integer('commentsNum')->default('0')->comment('评论数');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
