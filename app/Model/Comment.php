<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Comment
 *
 * @property int $id
 * @property int $content_id 外键
 * @property int $parent_id 父评论id
 * @property string $parent_name 父评论标题
 * @property string $username 评论者用户名
 * @property string $email 评论者邮箱
 * @property string $url 评论者博客地址
 * @property \App\Model\Content $content 评论内容
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Comment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Comment whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Comment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Comment whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Comment whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Comment whereParentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Comment whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Comment whereUsername($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{
    protected $table = 'comments';
    protected $guarded = [];
    //comment-content:Many-One
    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
