<?php

namespace App\Http\Controllers\Home;

use App\Model\Comment;
use App\Model\Content;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $content = Content::with('metas')
            ->with('tags')
            ->with('user')
            ->get();
        $comments_desc = Comment::with("comment_content")->orderBy('created_at', 'desc')->get();
        $content_desc = Content::orderBy('created_at', 'desc')->get();

        \SEOMeta::setTitle(env("SITE_NAME"));
        \SEOMeta::setDescription(env('SITE_describe'));
        \SEOMeta::setCanonical(env('SITE_address'));
        \SEOMeta::addKeyword([env('SITE_KEY')]);

        \OpenGraph::setDescription(env('SITE_describe'));
        \OpenGraph::setTitle(env("SITE_NAME"));
        \OpenGraph::setUrl(env('SITE_address'));
        \OpenGraph::addProperty('type', 'articles');

        \OpenGraph::addProperty('type', 'article');
        \OpenGraph::addProperty('locale', 'pt-br');
        \OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);

        return \Theme::view('index', compact('content', 'comments_desc', 'content_desc'));
    }
    
    public function archives(Request $request, $slug)
    {
        $content = Content::where("slug", "=", $slug)
            ->with('metas')
            ->with('tags')
            ->with('user')
//            ->with('comments')
            ->first();
        $commentss = Comment::where("content_id", "=", $content->id)->get()->toTree();
        $key = collect($content->tags)->map(function ($k) {
            return $k['name'];
        });

        \SEOMeta::setTitle($content->title);
        \SEOMeta::setDescription(str_limit($content->text,"100","... ..."));
        \SEOMeta::setCanonical(env('SITE_address'));
        \SEOMeta::addKeyword($key);

        \OpenGraph::setDescription(str_limit($content->text,"100","... ..."));
        \OpenGraph::setTitle($content->title);
        \OpenGraph::setUrl(env('SITE_address'));
        \OpenGraph::addProperty('type', 'articles');
        \OpenGraph::addProperty('type', 'article');
        \OpenGraph::addProperty('locale', 'pt-br');
        \OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);

        \OpenGraph::setTitle($content->title)
            ->setDescription(str_limit($content->text,"100","... ..."))
            ->setType('article')
            ->setArticle([
                'published_time' => $content->created_at,
                'modified_time' => $content->updated_at,
                'author' => $content->user->name,
                'tag' => implode("/",$key->toArray())
            ]);

        return \Theme::view("archives");
    }

    public function comment_create(Request $request, $post_id)
    {
        $parent = $request->post('parent') ?? 0;
        $input = $request->except(['_token', 'content']);
        $string = string_remove_xss($request->post('content')) == $request->post('content') ? $request->post('content') : string_remove_xss($request->post('content')) . '<img src="/themes/snow/assets/img/xss.jpg" alt="友情提示,这兄弟玩xss被我捉住了！！">';
        if (is_null(session('user_info'))) {
            $request->session()->put('user_info', [
                    'username' => $request->post('username'),
                    'email' => $request->post('email'),
                    'url' => $request->post('url'),
                ]
            );
        }
        if ($parent != 0) {
            $c = Comment::where("id", "=", $parent)->first();
            $collect = collect(
                [session('user_info') ?? $input,
                    [
                        'parent' => $request->post('parent'),
                        'content_id' => $post_id,
                        'content' => $string,
                        'is_blog' => 0
                    ]
                ]);
            $collapsed = $collect->collapse();
//            dump($collapsed->toArray());
            $child = $c->createChild($collapsed->toArray());

            Content::where("id", "=", $post_id)->update(["commentsNum" => Comment::where("content_id", "=", $post_id)->count()]);


            $da = Comment::where("id", "=", $child->id)->with("comment_content")->first();

            reply_em($da,$c);



            return redirect("archives/{$da->comment_content->slug}.html#comments-{$child->id}");


        } else {
            $collect = collect(
                [
                    ["parent" => $parent], session('user_info') ?? $input,
                    [
                        'content_id' => $post_id,
                        'content' => $string,
                        'is_blog' => 0
                    ]
                ]);
            $collapsed = $collect->collapse();
            $comm = Comment::create($collapsed->toArray());
            if ($comm) {
                //更新评论条数
                Content::where("id", "=", $post_id)->update(["commentsNum" => Comment::where("content_id", "=", $post_id)->count()]);


                $da = Comment::where("id", "=", $comm->id)->with("comment_content")->first();

                $us = User::find($da->comment_content->user_id);

                send_em($da, $us);

                return redirect("archives/{$da->comment_content->slug}.html#comments-{$comm->id}");
            }
        }
    }

    public function logout(Request $request, $id)
    {
        $request->session()->flush();
        return redirect("archives/{$id}.html#comments-1");
    }
}
