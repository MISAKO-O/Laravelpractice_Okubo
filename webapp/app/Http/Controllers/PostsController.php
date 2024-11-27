<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Author;
use App\Models\User;
use App\Http\Requests\PostRequest;

use DB;
use Log;

class PostsController extends Controller
{
    public function index()
    {
        $model = new Post();
        $posts = $model->getPosts();
        return view('list', [
            'posts' => $posts
        ]);
    }
    //入力画面の空欄の時最初の画面
    public function showCreate()
    {
        $authors = Author::all();
        return view('create',[
            'authors' => $authors
        ]);
    }
    //ユーザーが入力してDBにデータを送ってくれるところ
    public function storePost(PostRequest $request)
    {
        $model = new Post();
        $validatedData = $request->validated();
        try{
            DB::beginTransaction();
            $model->storePost($validatedData);
            DB::commit();
        } catch(\Exception $e){
            Log::error($e);
            DB::rollback();
            return redirect()->route('index');
        }

        return redirect()->route('index');
    }
    //編集画面を表示してくれるところ
    public function showEdit($id)
    {
        $post = Post::find($id);
        $authors = Author::all();

        return view ('edit', [
            'post' => $post,
            'authors' => $authors
        ]);
    }
    //編集画面で入力されたデータをDBに送ってくれるところ
    public function registEdit(PostRequest $request, $id)
    {
        $model = new Post();
        $varidatedData = $request->validated();
        try{
            DB::beginTransaction();
            $model->updatePost($varidatedData, $id);
            DB::commit();
        } catch(\Exception $e){
            Log::error($e);
            DB::rollback();
            return redirect()->route('index');
        }
        return redirect()->route('index');
    }
    //
    public function update(Request $request, $id)
    {
        $model = new Post();
        $validated = $request->validate([
            'title'=>'required | max:255',
            'author_id'=>'required | integer',
            'content'=>'nullable | max:1000',
        ]);

        $posts = Post::find($id);
        $posts->name = $request->name;
        $posts->author_id = $request->author_id;
        $posts->title = $request->title;
        $posts->save();
    }
    //削除画面DBに削除指示出すところ
    public function deletePost($id)
    {
        $model = new Post();
        try{
            DB::beginTransaction();
            $model->deletePost($id);
            DB::commit();
        } catch(\Exception $e){
            Log::error($e);
            DB::rollback();
            return redirect()->route('index');
        }
        return redirect()->route('index');
    }
}