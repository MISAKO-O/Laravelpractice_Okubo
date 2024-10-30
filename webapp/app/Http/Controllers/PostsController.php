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

    public function showCreate()
    {
        $authors = Author::all();
        return view('create',[
            'authors' => $authors
        ]);
    }

    public function storePost(Request $request)
    {
        $model = new Post();
        $validated = $request->validate([
            'title'  => 'required | max:255',
            'author_id'  => 'required | integer',
            'name'  => 'nullable | max:1000',
        ]);
        try{
            DB::beginTransaction();
            $model->storePost($request);
            DB::commit();
        } catch(\Exception $e){
            Log::error($e);
            DB::rollback();
            return redirect()->route('index');
        }

        return redirect()->route('index');
    }
    
    public function showEdit($id)
    {
        $post = Post::find($id);
        $authors = Author::all();

        return view ('edit', [
            'post' => $post,
            'authors' => $authors
        ]);
    }

    public function registEdit(Request $request, $id)
    {
        $model = new Post();
        try{
            DB::beginTransaction();
            $model->updatePost($request, $id);
            DB::commit();
        } catch(\Exception $e){
            Log::error($e);
            DB::rollback();
            return redirect()->route('index');
        }
        return redirect()->route('index');
    }

    public function update(Request $request, $id)
    {
        $model = new Post();
        $validated = $request->validate([
            'title'=>'required | max:255',
            'author_id'=>'required | integer',
            'name'=>'nullable | max:1000',
        ]);

        $posts = Post::find($id);
        $posts->name = $request->name;
        $posts->author_id = $request->author_id;
        $posts->title = $request->title;
        $posts->save();
    }

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