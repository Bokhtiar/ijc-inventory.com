<?php

namespace App\Traits;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait ReportTrait
{
    public function generateReport($filter)
    {
        switch ($filter) {
            case 'day':
                return $this->generateDayReport();
                break;
            case 'week':
                return $this->generateWeekReport();
                break;
            case 'month':
                return $this->generateMonthReport();
                break;
            case 'year':
                return $this->generateYearReport();
                break;
            default:
                return [];
                break;
        }
    }

    protected function generateDayReport()
    {
        if (Auth::user()->role_id == 1) {
            $tasks = Task::with(['company', 'assign', 'created_by', "created_by_boss_id"])
                ->whereDate('created_at', today())
                ->latest()->get();
            return $tasks;
        } else {
            $tasks = [];
            $tasks = Task::with(['company', 'assign', 'created_by', 'created_by_boss_id'])
                ->whereDate('created_at', today())
                ->latest()
                ->get();

            $tasks_boss = Task::with(['company', 'assign', 'created_by', "created_by_boss_id"])
                ->whereDate('created_at', today())
                ->latest()
                ->get();


            // Merge collections of objects
            $tasks = $tasks->merge($tasks_boss);
            return $tasks;
        }

        //return Task::with(['company', 'assign', 'created_by', "created_by_boss_id"])->whereDate('created_at', today())->get();
    }

    protected function generateWeekReport()
    {
        return Task::with(['company', 'assign', 'created_by', "created_by_boss_id"])->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->get();
    }

    protected function generateMonthReport()
    {
        return Task::with(['company', 'assign', 'created_by', "created_by_boss_id"])->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->get();
    }

    protected function generateYearReport()
    {
        return Task::with(['company', 'assign', 'created_by', "created_by_boss_id"])->whereYear('created_at', now()->year)->get();
    }
}
