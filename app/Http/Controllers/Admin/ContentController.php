<?php

namespace App\Http\Controllers\Admin;

use App\Model\Comment;
use App\Model\Content;
use App\Model\Metas;
use App\Model\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\Null_;

class ContentController extends Controller
{
    /**
     * Notes:文章列表页
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 11:57
     * Function Name: index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //根据主模型加载出确切关系
        $contents = Content::withTrashed()
            ->with('metas')
            ->with('user')
            ->with('tags')
            ->paginate(10);
        return view('admin.content.index', compact('contents'));
    }

    /**
     * Notes:文章添加页面
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 11:57
     * Function Name: add
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        //TODO:页面URL
        return view("admin.content.add");
    }

    /**
     * Notes:添加文章
     * User: iatw
     * Date: 2018/4/2
     * Time: 14:41
     * Function Name: create
     * @param Request $request
     */
    public function create(Request $request)
    {
        //判断是否允许评论
        $criticism = array_key_exists("criticism", $request->post()) ? 1 : 2;
        $input = $request->except(['_token', 'cover', 'tags', 'criticism', 'my-editormd-markdown-doc', 'my-editormd-html-code']);
        $content = Content::create(array_merge($input, [
            "criticism" => $criticism,
            "html" => $request->post('my-editormd-html-code'),
            "text" => $request->post('my-editormd-markdown-doc'),//htmlentities()
            "cover" => $request->post('cover') ?? null,
            //"summary" => str_limit($request->post('summary'), $limit = 100, $end = '...'),
            "user_id" => \Auth::user()->id,
            "types" => "1",//'types:{"1":"文章","2":"页面","3":"说说"}'
        ]));
        //验证下别名是否为空,不为空不管 为空更新别名
        $request->post('slug') ?? Content::where("id", "=", $content->id)
            ->update(["slug" => $content->id]);
        if (!is_null($request->post('tags'))) {
            //拆分tags
            $tags = explode(",", $request->post('tags'));
            //记录tags
            $ids = array();
            foreach ($tags as $v) {
                //不存在就添加 存在直接返回id
                $res = Tag::firstOrCreate(["name" => $v]);
                $ids[] = $res->id;
            }
            //添加关联表信息
            $content->tags()->attach($ids);
        }

        //更新分类下文章数量
        Metas::where("id", "=", $request->post("metas_id"))
            ->update(
                [
                    "content_count" => Content::where("metas_id", "=", $request->post("metas_id"))
                        ->count()
                ]
            );
        return Prompt($content, "文章添加", "Admin/content");
    }

    /**
     * Notes:修改文章
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 12:29
     * Function Name: edit
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            //判断是否允许评论
            $criticism = array_key_exists("criticism", $request->post()) ? 1 : 2;
            $input = $request->except(['_token', 'cover','tags', 'criticism', 'my-editormd-markdown-doc', 'my-editormd-html-code']);
            $content = Content::where("id", "=", $id)->update(array_merge($input, [
                "criticism" => $criticism,
                "html" => $request->post('my-editormd-html-code'),
                "text" => $request->post('my-editormd-markdown-doc'),//htmlentities()
                "user_id" => \Auth::user()->id,
                "types" => "1",
            ]));
            //验证下别名是否为空,不为空不管 为空更新别名
            $request->post('slug') ?? Content::where("id", "=", $content)->update(["slug" => $content]);
            if (!is_null($request->post('tags'))) {
                //拆分tags
                $tags = explode(",", $request->post('tags'));
                //记录tags
                $ids = array();
                foreach ($tags as $v) {
                    //不存在就添加 存在直接返回id
                    $res = Tag::firstOrCreate(["name" => $v]);
                    $ids[] = $res->id;
                }
                //使用集合取出所有的id
                $y = collect(Content::find($id)->tags()->get())->map(function ($k) {
                    return $k['id'];
                });
                //判断原来的tag是否多余现在提交的tag
                //如果原来的比现在的多就删除原来多余的关系
                //如果原来的比现在的少那么那么清除之前所有的添加现在的tag
                if (count($y->toArray()) > count($ids)) {
                    Content::find($id)->tags()->detach(array_diff($y->toArray(), $ids));
                } else {
                    Content::find($id)->tags()->detach();
                    Content::find($id)->tags()->attach($ids);
                }
//                dump($y->toArray());
//                dump($ids);
//                dump(array_diff($y->toArray(), array_intersect_assoc($y->toArray(), $ids)));
//                Content::find($id)->tags()->detach();
//                dump(count($y->toArray()) > count($ids));
            }
            return Prompt($content, "文章修改", "Admin/content");
        } else {
            //根据id查询当前这条数据
            $contents = Content::with('metas')->with('user')->with('tags')->find($id);
            //dump($contents);
            return view("admin.content.edit", compact('contents'));
        }
    }

    /**
     * Notes:软删除文章
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 14:23
     * Function Name: destroy
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //判断软删除文章是否成功
        if (Content::destroy($id)) {
            //查询该文章相关的评论
            $comms = Comment::where("content_id", '=', $id)->get();
            foreach ($comms as $com) {
                //并把评论表相关的数据软删除
                Comment::destroy($com->id);
                //更新content的commentsNum
                $content = Comment::withTrashed()->find($com->id);
                Content::withTrashed()->where("id", "=", $content->content_id)
                    ->update([
                        "commentsNum" => Comment::where("content_id", "=", $content->content_id)->count()
                    ]);
            }
            return redirect("/Admin/content")->with([
                    'message' => "已将该条文章放入回收站,你可以点击恢复来恢复此条数据",
                    'icon' => '6'
                ]
            );
        } else {
            return redirect("/Admin/content")->with([
                    'message' => "文章删除失败！！",
                    'icon' => '5'
                ]
            );
        }
    }

    /**
     * Notes:恢复 被软删除的文章
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 14:24
     * Function Name: restore
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $content = Content::withTrashed()->find($id);
        if ($content->restore()) {
            //查询该文章相关评论数据并恢复评论数据
            $comms = Comment::withTrashed()->where("content_id", '=', $id)->get()->toArray();
            foreach ($comms as $com) {
                $comid = Comment::withTrashed()->find($com['id']);
                $comid->restore();
                //更新content的commentsNum
                $content = Comment::find($com['id']);
                Content::where("id", "=", $content->content_id)
                    ->update([
                        "commentsNum" => Comment::where("content_id", "=", $content->content_id)->count()
                    ]);
            }
            return redirect("/Admin/content")->with([
                'message' => "已恢复该条文章",
                'icon' => '6'
            ]);
        } else {
            return redirect("/Admin/content")->with([
                'message' => "恢复失败！！",
                'icon' => '5'
            ]);
        }
    }

    /**
     * Notes:彻底删除文章
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 14:26
     * Function Name: delete
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $content = Content::where("id", "=", $id)->forceDelete();
        //同时把该文章的评论数据一起删除
        Comment::where("content_id", "=", $id)->forceDelete();

        return Prompt($content, "文章已彻底删除", "Admin/content");
    }

    /**
     * Notes:editor上传图片
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 14:27
     * Function Name: uploadimage
     * @param Request $request
     * @return string
     */
    public function uploadimage(Request $request)
    {
        $message = "";
        $file = $request->file('editormd-image-file');
        if ($file->isValid()) {
            $pathDir = date('Ymd');
            if (!\Storage::disk('public')->exists('/article/' . $pathDir)) {
                \Storage::disk('public')->makeDirectory('/article/' . $pathDir);
            }
            $originalName = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            $realPath = $file->getRealPath();
            $type = $file->getClientMimeType();
            $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
//              $bool = \Storage::disk('public')->put($filename, file_get_contents($realPath));
            $bool = $file->move("uploads/article/" . $pathDir, $filename);
//            if ($file->move($file->move("uploads/article/" . $pathDir, $filename))) {
//                $url = "/uploads/article/" . $pathDir . "/" . $filename;
//            } else {
//                $message = "1";
//            }
        }
        $data = array(
            'success' => 1,  //1：上传成功  0：上传失败
            'message' => $message,
            'url' => "/uploads/article/" . $pathDir . "/" . $filename
        );
        ob_end_flush();
        return json_encode($data);
    }

}
