<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Repositories\PostRepository;

class PostController extends Controller
{
    /**
     * ポストリポジトリーインスタンス
     *
     * @var PostRepository
     */
    protected $posts;

    /**
     * 新しいコントローラインスタンスの生成
     *
     * @return void
     */
    public function __construct(PostRepository $posts)
    {
        $this->middleware('auth');

        $this->posts = $posts;
    }

    /**
     * ユーザーの全ポストをリスト表示
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('posts.index', [
            'posts' => $this->posts->forUser($request->user()),
        ]);
    }

    /**
     * 新ポスト作成
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:255',
        ]);

        $request->user()->posts()->create([
            'content' => $request->content,
        ]);
    
        return redirect('/posts');
    }

    /**
     * 指定ポストの削除
     *
     * @param  Request  $request
     * @param  Post  $post
     * @return Response
     */
    public function destroy(Request $request, Post $post)
    {
        $this->authorize('destroy', $post);
        
        $post->delete();

        return redirect('/posts');
    }
}
