<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;


class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $data = [];
        
        if (\Auth::check()) {
            $user = \Auth::user();
            
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(5);
            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
        }
        
        return view('dashboard', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $task = new Task;

        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'content' => 'required|max:255',
            'status' => 'required|max:10',
        ]);
        
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status' => $request->status
        ]);
        
        // $task = new Task;
        // $task->content = $request->content;
        // $task->status = $request->status;
        // $task->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = \App\Models\Task::findOrFail($id);
        
        if (\Auth::id() === $task->user_id)
        {
            // メッセージ詳細ビューでそれを表示
            return view('tasks.show', [
                'task' => $task,
            ]);
          }
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $task = \App\Models\Task::findOrFail($id);
        
        if (\Auth::id() === $task->user_id){
           
           // メッセージ編集ビューでそれを表示
            return view('tasks.edit', [
            'task' => $task,
            ]); 
        }
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = \App\Models\Task::findOrFail($id);
        
        if (\Auth::id() === $task->user_id){
                
            $request->validate([
            'content' => 'required|max:255',
            'status' => 'required|max:10',
            ]);
            //
            // $task = Task::findOrFail($id);
            $task->content = $request->content;
            $task->status = $request->status;
            $task->save();

            // トップページへリダイレクトさせる
            return redirect('/');
        }
        return redirect('/');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = \App\Models\Task::findOrFail($id);
        
        if (\Auth::id() === $task->user_id){
            
            // $task = Task::findOrFail($id);
            // メッセージを削除
            $task->delete();

             // トップページへリダイレクトさせる
            return redirect('');   
        }
        return redirect('');
    }
}
