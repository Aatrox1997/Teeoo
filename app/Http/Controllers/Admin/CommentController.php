<?php

namespace App\Http\Controllers\Admin;

use App\Model\Comment;
use App\Model\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Notes:评论列表页
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 11:53
     * Function Name: index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $comment = Comment::withTrashed()->with('comment_content')->paginate(1);
        return view('admin.comment.index', compact('comment'));
    }

    /**
     * Notes:评论删除
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 11:56
     * Function Name: delete
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        //根据当前的评论id查询当前的文章id
        $cont = Comment::withTrashed()->find($id);
        //删除评论
        $Comment = Comment::where("id", "=", $id)->forceDelete();
        //同时删除下级评论
        Comment::where("parent", "=", $id)->forceDelete();
        // 清理冗余的关联信息
        Comment::deleteRedundancies();
        //更新文章的评论数commentsNum;
        Content::where("id", "=", $cont->content_id)
            ->update([
                "commentsNum" => Comment::where("content_id", "=", $cont->content_id)->count()
            ]);

        return Prompt($Comment, "数据删除", "/Admin/comment");
    }

    /**
     * Notes:编辑评论
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 11:56
     * Function Name: edit
     * @param Request $request
     * @param $id
     */
    public function edit(Request $request, $id)
    {
        //post修改数据 get查询出数据
        if ($request->isMethod('post')) {

        } else {
            
        }
    }

    /**
     * Notes:回复评论
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 11:57
     * Function Name: Reply
     */
    public function Reply()
    {
        
    }
}
