<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    protected $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function store(Request $request)
    {
        $todo = $this->todo->createTodo($request->all());
        return response()->json($todo);
    }

    public function update($id, Request $request)
    {
        try{
            $todo = $this->todo->updateTodo($request->all());
            return response()->json($todo);
        }catch (ModelNotFoundException $exception) {
            return response()->json(["msg"=>$exception->getMessage()],status:404);
        }
    }

    public function get($id)
    {
        $todo = $this->todo->getTodo($id);
        if($todo){
            return response()->json(["msg"=>"Todo item not found"], status:404);
        }
    }

    public function gets()
    {
        $todos = $this->todo->getTodo();
        return response()->json($todos);
    }

    public function delete($id)
    {
        try{
            $todo = $this->todo->deletTodo($id);
            return response()->json(["msg"=>"delete todo success"]);
        }catch (ModelNotFoundException $exception) {
            return response()->json(["msg"=>$exception->getMessage()],status:404);
        }
    }
}
