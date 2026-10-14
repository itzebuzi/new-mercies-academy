<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_applications' => Admission::count(),
            'pending_applications' => Admission::where('status', 'pending')->count(),
            'reviewing_applications' => Admission::where('status', 'reviewing')->count(),
            'accepted_applications' => Admission::where('status', 'accepted')->count(),
            'rejected_applications' => Admission::where('status', 'rejected')->count(),
        ];

        $recentApplications = Admission::query()
            ->latest()
            ->take(6)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentApplications'));
    }
}
