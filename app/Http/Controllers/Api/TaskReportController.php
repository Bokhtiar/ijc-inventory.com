<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Traits\ReportTrait;
use App\Traits\HttpResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskReportController extends Controller
{
    /** report */
    use ReportTrait;
    use HttpResponseTrait;

    public function report(Request $request,$filter)
    { 
        $reportData = $this->generateReport($request, $filter);
        return $this->HttpSuccessResponse($filter. ' ' ."report", $reportData, 200);
    }

    /** date between */
    public function date_between(Request $request)
    {
        $type = $request->type;
        $status = $request->status;
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        if (Auth::user()->role_id == 1) {
            $tasks = Task::with(['company', 'assign', 'created_by', "created_by_boss_id"])
            ->whereBetween('created_at', [$startDate, $endDate])
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
            ->whereBetween('created_at', [$startDate, $endDate])
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
            ->whereBetween('created_at', [$startDate, $endDate])
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
}
