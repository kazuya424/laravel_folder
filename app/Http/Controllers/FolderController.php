<?php

namespace App\Http\Controllers;

use App\Folder; // ★ この行を追記！
use App\Http\Requests\CreateFolder; // ★ 追加
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class FolderController extends Controller
{
    //
    public function showCreateForm()
    {
        return view('folders/create');
    }

    public function create(CreateFolder $request)
    {
        // フォルダモデルのインスタンスを作成する
        $folder = new Folder();
        // タイトルに入力値を代入する
        $folder->title = $request->title;

        Auth::user()->folders()->save($folder);

        // インスタンスの状態をデータベースに書き込む
        $folder->save();

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}
