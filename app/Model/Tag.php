<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Tag
 *
 * @property int $id
 * @property string $name 标签名称
 * @property int $hot 标签热度
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Content[] $content
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tag whereHot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{
    protected $table = 'tags';
    protected $guarded = [];

    public function content()
    {
        return $this->belongsToMany(Content::class)->withTimestamps();
    }
}
