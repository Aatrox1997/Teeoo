<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MestsRequests;
use App\Model\Content;
use App\Model\Metas;
use App\Http\Controllers\Controller;

class MetasController extends Controller
{
    /**
     * Notes:分类列表页
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 14:30
     * Function Name: index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $metas = Metas::withTrashed()->paginate(10);
        return view("admin.metas.index", compact('metas'));
    }

    /**
     * Notes:添加分类
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 14:30
     * Function Name: store
     * @param MestsRequests $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MestsRequests $request)
    {
        $token = $request->input('token');
        $input = $request->except(['_token']);
        if ($request->post("parent") != 0) {
            $input = $request->except(['parent']);
            $parent = Metas::where("id", "=", $request->post("parent"))->first();

            $child = $parent->createChild($input);

            $count = Metas::where("id", "=", $request->post('parent'))
                ->update([
                    "types_count" => Metas::where("parent", "=", $request->post('parent'))
                        ->count()
                ]);
            return Prompt($count, "分类添加", "/Admin/metas/");
        } else {
            $metas = Metas::create($input);
            return Prompt($metas, "分类添加", "/Admin/metas/");
        }

    }

    /**
     * Notes:编辑视图
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 14:31
     * Function Name: edit
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $metas = Metas::find($id);
        $metas_all = Metas::all();
        return view("admin.metas.update", compact('metas', 'metas_all'));
    }

    /**
     * Notes:修改分类
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 14:31
     * Function Name: update
     * @param MestsRequests $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MestsRequests $request, $id)
    {
        $me = Metas::find($id);
        $parent = $me->parent;

        $input = $request->except(['_token']);
        $metas = Metas::where("id", "=", $id)->update($input);

        //更新之前子分类的数量
        Metas::where("id", "=", $parent)
            ->update([
                "types_count" => Metas::where("parent", "=", $parent)
                    ->count()
            ]);

        //更新现在子分类的数量
        Metas::where("id", "=", $request->post('parent'))
            ->update([
                "types_count" => Metas::where("parent", "=", $request->post('parent'))
                    ->count()
            ]);

        // 修复树关联
        Metas::find($id)->perfectTree();

        // 清理冗余的关联信息
        Metas::deleteRedundancies();

        return Prompt($metas, "分类修改", "/Admin/metas/");


    }

    /**
     * Notes:软删除
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 14:32
     * Function Name: destroy
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $de = Metas::where("parent", "=", $id)->count();
        if ($de > 0) {
            return redirect("/Admin/metas")->with([
                    'message' => "请先删除子分类！",
                    'icon' => '5'
                ]
            );
        } else {
            //如果该分类下存在文章
            if (Content::where("metas_id", "=", $id)->count() > 0) {
                return redirect("/Admin/metas")->with([
                        'message' => "请您先删除该分类下的文章！！",
                        'icon' => '5'
                    ]
                );
            }
            $delete = Metas::destroy($id);
            if ($delete) {
                return redirect("/Admin/metas")->with([
                        'message' => "已将该条数据放入回收站,你可以点击恢复来恢复此条数据",
                        'icon' => '6'
                    ]
                );
            } else {
                return redirect("/Admin/metas")->with([
                        'message' => "数据删除失败,我也不知道啥原因！！",
                        'icon' => '5'
                    ]
                );
            }
        }
    }

    /**
     * Notes:恢复软删除
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 14:32
     * Function Name: restore
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $metas = Metas::withTrashed()->find($id);

        $me = $metas->restore();
        // 修复树关联
        Metas::find($id)->perfectTree();
        // 清理冗余的关联信息
        Metas::deleteRedundancies();
        return Prompt($me, "恢复数据", "/Admin/metas");
    }

    /**
     * Notes:彻底删除
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 14:33
     * Function Name: delete
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $delete = Metas::where("id", "=", $id)->forceDelete();
        // 修复树关联
        // Metas::find($id)->perfectTree();

        // 清理冗余的关联信息
        Metas::deleteRedundancies();
        return Prompt($delete, "数据删除", "/Admin/metas/");
    }
}
