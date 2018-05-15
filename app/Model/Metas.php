<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jiaxincui\ClosureTable\Traits\ClosureTable;

/**
 * App\Model\Metas
 *
 * @property int $id
 * @property int $parent
 * @property string $types 类型名
 * @property string|null $slug 别名
 * @property string|null $icon 图标
 * @property int $content_count 该分类下文章总数
 * @property string|null $description 描述
 * @property int|null $types_count 子分类数量
 * @property int|null $order 排序
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Content[] $contents
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Metas isolated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Metas onlyRoot()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Metas whereContentCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Metas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Metas whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Metas whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Metas whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Metas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Metas whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Metas whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Metas whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Metas whereTypes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Metas whereTypesCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Metas whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Metas onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Metas withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Metas withoutTrashed()
 */
class Metas extends Model
{
    use SoftDeletes;
    use ClosureTable;

    protected $table = 'metas';
    protected $guarded = [];

    //metas-contents:One-Many
    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
