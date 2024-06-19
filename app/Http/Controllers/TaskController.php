<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;


class TaskController extends Controller
{
    
    public function index()
    {
        $user_id = Auth::id();
        $tasks = Task::where('user_id', $user_id)
                    ->where('completed',false)
                    ->orderBy('priority', 'desc')
                    ->orderBy('due_date')
                    ->get();
        
        return view('dashboard',compact('tasks'));
    }

    public function create()
    { 
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();
        $request->validate([
            'title'=>'required|max:255',
            'description'=>'nullable|max:255',
            'priority'=>'required|max:255',
            'due_date'=>'nullable|max:255',
        ]);
        Task::create([
            
            'user_id'=> $user_id,
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'priority'=>$request->input('priority'),
            'due_date'=>$request->input('due_date'),
        ]);
        
        return redirect()->route('tasks.index')->with('success', 'Task Created Successfully');
    }
    public function edit(Task $task)
    {
        
        return view('tasks.edit',compact('task'));
    }

    public function update(Request $request,Task $task)
    {
        $request->validate([
            'title'=>'required|max:255',
            'description'=>'nullable|max:255',
            'priority'=>'required|in:low,medium,high',
            'due_date'=>'nullable|max:255',
        ]);
        $task->update([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'priority'=>$request->input('priority'),
            'due_date'=>$request->input('due_date'),
        ]);
        
        return redirect()->route('tasks.index')->with('success', 'Task Updated Successfully');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task Deleted Successfully');
    }
}
