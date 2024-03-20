<?php

namespace App\Traits;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait ReportTrait
{
    public function generateReport($request, $filter)
    {
        switch ($filter) {
            case 'day':
                return $this->generateDayReport($request);
                break;
            case 'week':
                return $this->generateWeekReport($request);
                break;
            case 'month':
                return $this->generateMonthReport($request);
                break;
            case 'year':
                return $this->generateYearReport($request);
                break;
            default:
                return [];
                break;
        }
    }

    protected function generateDayReport($request)
    {
        $type = $request->type;
        $status = $request->status;
        if (Auth::user()->role_id == 1) {
            return Task::with(['company', 'assign', 'created_by', "created_by_boss_id"])
                ->whereDate('created_at', today())
                ->when($type !== null, function ($query) use ($type) {
                    return $query->where('type', $type);
                })
                ->when($status, function ($query) use ($status) {
                    return $query->where('status', $status);
                })
                ->latest()->get();

            // return $this->HttpSuccessResponse('Task list.', $tasks, 200);
        } else {
            $tasks = [];
            $tasks = Task::with(['company', 'assign', 'created_by', 'created_by_boss_id'])
                ->whereDate('created_at', today())
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
                ->whereDate('created_at', today())
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
            return $tasks->merge($tasks_boss);
            //return $this->HttpSuccessResponse('Task list.', $tasks, 200);
        }
    }

    protected function generateWeekReport($request)
    {
        $type = $request->type;
        $status = $request->status;
        if (Auth::user()->role_id == 1) {
            return Task::with(['company', 'assign', 'created_by', "created_by_boss_id"])
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->when($type !== null, function ($query) use ($type) {
                    return $query->where('type', $type);
                })
                ->when($status, function ($query) use ($status) {
                    return $query->where('status', $status);
                })
                ->latest()->get();

            // return $this->HttpSuccessResponse('Task list.', $tasks, 200);
        } else {
            $tasks = [];
            $tasks = Task::with(['company', 'assign', 'created_by', 'created_by_boss_id'])
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
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
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
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
            return $tasks->merge($tasks_boss);
            //return $this->HttpSuccessResponse('Task list.', $tasks, 200);
        }
    }

    protected function generateMonthReport($request)
    {
        $type = $request->type;
        $status = $request->status;
        if (Auth::user()->role_id == 1) {
            return Task::with(['company', 'assign', 'created_by', "created_by_boss_id"])
                ->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)
                ->when($type !== null, function ($query) use ($type) {
                    return $query->where('type', $type);
                })
                ->when($status, function ($query) use ($status) {
                    return $query->where('status', $status);
                })
                ->latest()->get();

            // return $this->HttpSuccessResponse('Task list.', $tasks, 200);
        } else {
            $tasks = [];
            $tasks = Task::with(['company', 'assign', 'created_by', 'created_by_boss_id'])
                ->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)
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
                ->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)
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
            return $tasks->merge($tasks_boss);
            //return $this->HttpSuccessResponse('Task list.', $tasks, 200);
        }

    }

    protected function generateYearReport($request)
    {
        $type = $request->type;
        $status = $request->status;
        if (Auth::user()->role_id == 1) {
            return Task::with(['company', 'assign', 'created_by', "created_by_boss_id"])
                ->whereYear('created_at', now()->year)
                ->when($type !== null, function ($query) use ($type) {
                    return $query->where('type', $type);
                })
                ->when($status, function ($query) use ($status) {
                    return $query->where('status', $status);
                })
                ->latest()->get();

            // return $this->HttpSuccessResponse('Task list.', $tasks, 200);
        } else {
            $tasks = [];
            $tasks = Task::with(['company', 'assign', 'created_by', 'created_by_boss_id'])
                ->whereYear('created_at', now()->year)
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
                ->whereYear('created_at', now()->year)
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
            return $tasks->merge($tasks_boss);
            //return $this->HttpSuccessResponse('Task list.', $tasks, 200);
        }

        //return Task::with(['company', 'assign', 'created_by', "created_by_boss_id"])->whereYear('created_at', now()->year)->get();
    }
}
