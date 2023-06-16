<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class TaskController extends Controller
{
   
    
    public function index()
    {
        try {
            $token = session('jwt_token');
            JWTAuth::setToken($token);
            $user = JWTAuth::toUser();
        } catch (\Exception $e) {
           
            return redirect()->route('login');
        }


        
        $tasks = Task::where('user_id',$user->id)->get();
        return view('tasks.index', compact('tasks'));
    }

    
    public function create()
    {
        try {
            $token = session('jwt_token');
            JWTAuth::setToken($token);
            $user = JWTAuth::toUser();
        } catch (\Exception $e) {
           
            return redirect()->route('login');
        }

        return view('tasks.create');
    }

    
    public function store(Request $request)
    {
        try {
            $token = session('jwt_token');
            JWTAuth::setToken($token);
            $user = JWTAuth::toUser();
        } catch (\Exception $e) {
           
            return redirect()->route('login');
        }


        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $record = new Task();
        $record->title = $request->title;
        $record->description = $request->description;
        $record->user_id = $user->id;
        $record->save();
        //Task::create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        try {
            $token = session('jwt_token');
            JWTAuth::setToken($token);
            $user = JWTAuth::toUser();
        } catch (\Exception $e) {
           
            return redirect()->route('login');
        }

        return view('tasks.edit', compact('task'));
    }
    public function update(Request $request, Task $task)
    {
        try {
            $token = session('jwt_token');
            JWTAuth::setToken($token);
            $user = JWTAuth::toUser();
        } catch (\Exception $e) {
           
            return redirect()->route('login');
        }

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'completed' => 'required',
        ]);

        
        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }
    public function destroy(Task $task)
    {
        try {
            $token = session('jwt_token');
            JWTAuth::setToken($token);
            $user = JWTAuth::toUser();
        } catch (\Exception $e) {
           
            return redirect()->route('login');
        }
        
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function test()
    {
        return "Working fine.";
    }


}
