<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class PostController extends Controller
{
    public function index()
    {
        $userID = Auth::user()->id;
        $posts = Post::orderBy('created_at', 'desc')->where('id', $userID)->get();
        return view('admin.post.list', compact('posts'));
    }

    public function redis()
    {
        // Redis::set('email','danieldavies9988@gmail.com');
        // echo Redis::get('email');
        $value = Cache::store('file')->remember('users', 120, function () {
            // return DB::table('users')->get();
            return [
                'User 1', 'User 2', 'User 3'
            ];
        });

        Cache::tags(['people', 'artists'])->put('name', 'Daniel', 120);
        Cache::tags(['people', 'authors'])->put('age', 30, 120);
        $name = Cache::tags(['people', 'artists'])->get('name');
        $age = Cache::tags(['people', 'authors'])->get('age');
        dd($$name,$age);
    }

    public function add()
    {
        return view('admin.post.add');
    }

    public function postAdd(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ], [
            'title.required' => 'Title can not be empty',
            'content.unique' => 'Content can not be empty',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect()->route('admin.posts.index')->with('msg', 'New post created...');
    }

    public function update(Post $post)
    {
        $this->authorize('update', $post);
        return view('admin.post.edit', compact('post'));
    }
    public function postUpdate(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ], [
            'title.required' => 'Title can not be empty',
            'content.unique' => 'Content can not be empty',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        return redirect()->route('admin.posts.index')->with('msg', 'New post created...');
    }
    public function delete(Post $post)
    {
        $this->authorize('delete', $post);
        Post::destroy($post->id);
        return redirect()->route('admin.post.list')->with('msg', 'Post deleted!');
    }
}
