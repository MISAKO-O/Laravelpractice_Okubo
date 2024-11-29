<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Log; 



class RemotePostController extends Controller
{
    //データの取得と返却
    public function index() {
         
    }
    
    // データの保存処理
    public function store(PostRequest $request) {
        $model = new Post();
        $validatedData = $request->validated();
        try {
          DB::beginTransaction();
          $model->storePost($validatedData);
          DB::commit();
          return response()->json(['message' => 'success post', 'data' => $validatedData]);
        } catch (\Exception $e) {
          Log::error($e);
          DB::rollback();
          return response()->json(['error' => $e->getMessage()], 500);
        }
          
    }
    //データ処理のロジック
    // 全てのデータをまとめて取得
   

    //データの更新処理
    public function update(Request $request, $id) {

    }

    //データの削除処理
    public function destroy($id) {

    }
}
