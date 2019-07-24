<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task; //Taskモデル

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     * トップページ
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index',['tasks' => $tasks,]);
    }


    /**
     * Show the form for creating a new resource.
     * 新規タスク作成ページ
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task;
        return view('tasks.create',['task'=>$task,]);
    }


    /**
     * Store a newly created resource in storage.
     * 新規タスク保存してトップに戻る
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //空文字&文字数のバリデーション
        $this->validate($request,['content'=>'required|max:191']);
        
        $task = new Task;
        $task->content = $request->content;
        $task->save();
        return redirect('/');
    }


    /**
     * Display the specified resource.
     * タスクidのリンク内容個別表示ページ
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        return view('tasks.show',['task'=>$task,]);
    }


    /**
     * Show the form for editing the specified resource.
     * タスク内容編集ページ
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        return view('tasks.edit',['task'=>$task,]);
    }


    /**
     * Update the specified resource in storage.
     * 編集ページの内容を受け取り更新してトップに戻る
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //空文字&文字数のバリデーション
        $this->validate($request,['content'=>'required|max:191']);
        
        $task = Task::find($id);
        $task->content = $request->content;
        $task->save();
        return redirect('/');
    }


    /**
     * Remove the specified resource from storage.
     * タスク内容を破棄してトップに戻る
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect('/');
    }
}
