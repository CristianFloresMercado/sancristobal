<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user')->latest();

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('accion')) {
            $query->where('accion', $request->accion);
        }

        $logs = $query->paginate(20)->withQueryString();

        return view('admin.activity-logs.index', compact('logs'));
    }
}
