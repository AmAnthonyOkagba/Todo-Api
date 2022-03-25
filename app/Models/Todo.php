<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Todo extends Model
{
    use HasFactory;

    protected $table = "todos";

    public function createTodo(array $attributes)
    {
        $todo = new Todo();
        $todo->title = $attributes["title"];
        $todo->content = $attributes["content"];
        $todo->save();

        return $todo;
    }

    public function getTodo($id)
    {
        $todo = $this->where("id",$id)->first();

        return $todo;
    }

    public function getsTodo($id)
    {
        $todo = $this->all();

        return $todo;
    }

    public function updateTodo(int $id, array $attributes)
    {
        $todo = $this->getsTodo($id);
        if($todo ==null)
        {
            throw new ModelNotFoundException(message:"Cant find todo");
        }
        $todo->title = $attributes["title"];
        $todo->content = $attributes["content"];
        $todo->save();

        return $todo;
    }

    public function deleteTodo(int $id)
    {
        $todo = $this->getTodo($id);
        if($todo == null)
        {
            throw new ModelNotFoundException(message:"Cant find todo");
        }
        return $todo->delete();
    }

}
