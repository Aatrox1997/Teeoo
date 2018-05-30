<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Content
 *
 * @property int $id
 * @property int $metas_id 分类
 * @property string|null $title 标题
 * @property string|null $slug 别名
 * @property string|null $cover 封面
 * @property string|null $summary 概要
 * @property string|null $text 内容
 * @property string|null $html 解析内容
 * @property int $view_count 浏览次数
 * @property int|null $favorite_count 点赞次数
 * @property int $order 排序
 * @property int $user_id 作者
 * @property string $types types:{"1":"文章","2":"页面","3":"说说"}
 * @property string $criticism criticism:{"1":"允许评论","2":"不允许评论"}
 * @property string $template 模板
 * @property string $status status:{"publish":"公开","hidden":"隐藏","password":"密码保护","private":"私有","waiting":"待审核"}
 * @property string|null $pwd 密码
 * @property string|null $quote 引用通告
 * @property int $commentsNum 评论数
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Comment[] $comments
 * @property-read \App\Model\Metas $metas
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Tag[] $tags
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereCommentsNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereCriticism($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereFavoriteCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereHtml($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereMetasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content wherePwd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereQuote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereTypes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Content whereViewCount($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Content onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Content withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Content withoutTrashed()
 */
class Content extends Model
{
    use SoftDeletes;
    protected $table = 'content';
    protected $guarded = [];
    //content-metas:Many-One
    public function metas()
    {
        return $this->belongsTo(Metas::class);
    }

    //content-comments:One-Many
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //content-Tag:Many-Many
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
