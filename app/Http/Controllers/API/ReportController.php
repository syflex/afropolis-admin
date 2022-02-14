<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    //save report
    public function saveReport(Request $request)
    {
        $report = new Report();
        $report->resource_id = $request->resource_id;
        $report->user_id = $request->user_id;
        $report->type = $request->type;
        $report->reason = $request->reason;
        $report->save();
        return response()->json([
            'success' => true,
            'message' => 'Report saved successfully'
        ]);
    }
}
