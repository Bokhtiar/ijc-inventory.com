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
    public function index(Request $request)
    {
        $type = $request->type;
        $status = $request->status;
        if (Auth::user()->role_id == 1) {
            $tasks = Task::with(['company', 'assign', 'created_by', "created_by_boss_id"])
                ->when($type !== null, function ($query) use ($type) {
                    return $query->where('type', $type);
                })
                ->when($status, function ($query) use ($status) {
                    return $query->where('status', $status);
                })
                ->latest()->get();

            return $this->HttpSuccessResponse('Task list.', $tasks, 200);
        } else {
            $tasks = [];
            $tasks = Task::with(['company', 'assign', 'created_by', 'created_by_boss_id'])
                ->where(function ($query) use ($type, $status) {
                    $query->where('created_by', Auth::id());

                    if ($type !== null) {
                        $query->where('type', $type);
                    }

                    if ($status !== null) {
                        $query->where('status', $status);
                    }
                })
                ->orWhere(function ($query) use ($type, $status) {
                    $query->where('assign', Auth::id());

                    if ($type !== null) {
                        $query->where('type', $type);
                    }

                    if ($status !== null) {
                        $query->where('status', $status);
                    }
                })
                ->latest()
                ->get();




            $tasks_boss = Task::with(['company', 'assign', 'created_by', "created_by_boss_id"])
                ->where(function ($query) use ($type, $status) {
                    $query->where("created_by_boss_id", Auth::id());

                    if ($type !== null) {
                        $query->where('type', $type);
                    }

                    if ($status !== null) {
                        $query->where('status', $status);
                    }
                })
                ->orWhere(function ($query) use ($type, $status) {
                    $query->where('assign', Auth::id());

                    if ($type !== null) {
                        $query->where('type', $type);
                    }

                    if ($status !== null) {
                        $query->where('status', $status);
                    }
                })
                ->latest()
                ->get();

            

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
        if (Auth::user()->role_id == 1) {
            $task = Task::with(['company', 'assign', 'created_by', "created_by_boss_id"])->find($id);
            return $this->HttpSuccessResponse('Task details.', $task, 200);
        } else {
            $task = Task::find($id);
            if ($task->assign == Auth::id() || $task->created_by == Auth::id() || $task->created_by_boss_id == Auth::id()) {
                return $this->HttpSuccessResponse('Task details.', $task, 200);
            } else {
                $errorArray = ['Task not found or unauthorized.'];
                return $this->HttpErrorResponse(array($errorArray), 404);
            }
        }
    }


    /** resource update */
    public function update(TaskRequest $request, $id)
    {

        if (Auth::user()->role_id == 1) {
            $task = Task::find($id);

            if (!$task) {
                $errorArray = ['Task not found.'];
                return $this->HttpErrorResponse(array($errorArray), 404);
            }
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
        } else {
            // Find the task by ID and ensure it belongs to the authenticated user
            $task = Task::find($id);
            if ($task->assign == Auth::id() || $task->created_by == Auth::id() || $task->created_by_boss_id == Auth::id()) {
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
            } else {
                $errorArray = ['Task not found or unauthorized.'];
                return $this->HttpErrorResponse(array($errorArray), 404);
            }
        }
    }


    /** resource store */
    public function destroy($id)
    {
        if (Auth::user()->role_id == 1) {
            $task = Task::find($id)->delete();
            return $this->HttpSuccessResponse('Task details.', $task, 200);
        } else {
            $task = Task::find($id);
            if ($task->assign == Auth::id() || $task->created_by == Auth::id() || $task->created_by_boss_id == Auth::id()) {
                $data = $task->delete();
                return $this->HttpSuccessResponse('Task deleted.', $data, 200);
            } else {
                $errorArray = ['Task not found or unauthorized.'];
                return $this->HttpErrorResponse(array($errorArray), 404);
            }
        }
    }

    /** task status */
    public function status($id)
    {
        if (Auth::user()->role_id == 1) {
            $task = Task::find($id);
            if (!$task) {
                $errorArray = ['Task not found or unauthorized.'];
                return $this->HttpErrorResponse(array($errorArray), 404);
            }
            if ($task->status == 1) {
                $task->status = 0;
                $task->save();
                return $this->HttpSuccessResponse('Task details.', $task, 200);
            }else{
                $task->status = 1;
                $task->save();
                return $this->HttpSuccessResponse('Task details.', $task, 200);
            }
        } else {
            $task = Task::find($id);
            if (!$task) {
                $errorArray = ['Task not found or unauthorized.'];
                return $this->HttpErrorResponse(array($errorArray), 404);
            }
            if ($task->assign == Auth::id() || $task->created_by == Auth::id() || $task->created_by_boss_id == Auth::id()) {
                if ($task->status == 1) {
                    $task->status = 0;
                    $task->save();
                    return $this->HttpSuccessResponse('Task details.', $task, 200);
                } else {
                    $task->status = 1;
                    $task->save();
                    return $this->HttpSuccessResponse('Task details.', $task, 200);
                }
            } else {
                $errorArray = ['Task not found or unauthorized.'];
                return $this->HttpErrorResponse(array($errorArray), 404);
            }
        }
    }
}
