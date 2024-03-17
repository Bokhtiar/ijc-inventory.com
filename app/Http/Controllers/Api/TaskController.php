<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Traits\HttpResponseTrait;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    use HttpResponseTrait;
    /** reosurce list without paginate */
    public function index() 
    {
        if (Auth::user()->role_id == 1) {
            $tasks = Task::with('company')->latest()->get();
            return $this->HttpSuccessResponse('Task list.', $tasks, 200);
        } else {
            $tasks = [];
            $tasks = Task::with('company')->where("created_by", Auth::id())->get();
            $tasks_boss = Task::with('company')->where("created_by_boss_id", Auth::id())->get();

            // Merge collections of objects
            $tasks = $tasks->merge($tasks_boss);
            return $this->HttpSuccessResponse('Task list.', $tasks, 200);
        }
        
    }

    /** resource store */
    public function store(TaskRequest $request)
    {
        $task = Task::create([
            'company_id' => $request->company_id,
            'issue_type' => $request->issue_type,
            'type' => $request->type,
            'status' => $request->status,
            'summary' => $request->summary,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
            'assign' => $request->assign,
            'start_date' => $request->start_date,
            'created_by' => Auth::id(),
            'created_by_boss_id' => Auth::user()->created_by ? Auth::user()->created_by : 1,
        ]);
        return $this->HttpSuccessResponse('Task created.', $task, 201);
    }

    /** resource store */
    public function show($id)
    {
        $task = Task::find($id);
        return $this->HttpSuccessResponse('Task details.', $task, 200);
    }

    /** resource update */
    public function update(TaskRequest $request, $id)
    {
        $task = Task::find($id);
        $data = $task->update([
            'company_id' => $request->company_id,
            'issue_type' => $request->issue_type,
            'type' => $request->type,
            'status' => $request->status,
            'summary' => $request->summary,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
            'assign' => $request->assign,
            'start_date' => $request->start_date,
            'created_by' => Auth::id(),
            'created_by_boss_id' => Auth::user()->created_by ? Auth::user()->created_by : 1,
        ]);
        return $this->HttpSuccessResponse('Task updated.', $data, 201);
    }

    /** resource delete */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return $this->HttpSuccessResponse('Task deleted.', $task, 204);
    }
}
