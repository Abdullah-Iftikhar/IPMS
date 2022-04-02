<?php

namespace App\Http\Controllers;

use App\Models\Property;

class ReportController extends Controller
{
    public function index($key)
    {
        $returnArr['key'] = $key;
        $returnArr['properties'] = Property::where('status', $key)
            ->where(function ($query) {
                if (isset($_GET['start_date']) && $_GET['start_date'] != '' && isset($_GET['end_date']) && $_GET['end_date'] != '') {
                    $query->whereBetween('created_at', [trim($_GET['start_date']), trim($_GET['end_date'])]);
                }
            })
            ->get();
        return view('admin.reports.list', $returnArr);
    }
}
