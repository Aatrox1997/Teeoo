<?php

namespace App\Http\Controllers\Admin;

use App\Model\Content_tag;
use App\Model\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    /**
     * Notes:标签列表
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 14:38
     * Function Name: index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $tags = Tag::paginate('10');
        return view('admin.tags.index',compact('tags'));
    }

    /**
     * Notes:
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 14:39
     * Function Name: show
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        return response()->json([ 'success' => true, 'data'=>$tag]);
    }

    /**
     * Notes:修改标签
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 14:40
     * Function Name: edit
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request)
    {
        //dd($request->all());
        //查询提交的标签名称是否存在
        $data = Tag::where("name","=",$request->name)->get();
        if($data->count()){
            return redirect("Admin/tags")->with(["message" => "该标签已经存在","icon" => 5]);
        }
        $tag = Tag::where("id","=",$request->id)->update(["name" => $request->name]);
        return Prompt($tag,"编辑标签","Admin/tags");

    }


}
