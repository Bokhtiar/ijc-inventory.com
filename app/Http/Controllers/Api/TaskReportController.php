<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ReportTrait;
use App\Traits\HttpResponseTrait;
use Illuminate\Http\Request;

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
}
