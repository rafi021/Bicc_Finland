<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Donor;
use App\Models\CommunityMember;
use App\Models\ClassRegistration;
use App\Models\MosqueSetting;
use Illuminate\Support\Facades\DB;

class DashboardController extends BaseController
{
    public function index()
    {
        // Monthly Donation Data (Last 12 Months)
        $monthlyDonations = Donor::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('SUM(amount) as total')
        )
        ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // Fill in missing months with 0
        $chartLabels = [];
        $chartData = [];
        $current = now()->subMonths(11)->startOfMonth();
        $now = now()->endOfMonth();

        while ($current <= $now) {
            $monthKey = $current->format('Y-m');
            $record = $monthlyDonations->firstWhere('month', $monthKey);
            
            $chartLabels[] = $current->format('M Y');
            $chartData[] = $record ? $record->total : 0;
            
            $current->addMonth();
        }

        // Total Stats
        $totalDonors = Donor::count();
        $totalRaised = Donor::sum('amount');
        $totalCommunity = CommunityMember::count();
        $totalClassRegistrations = ClassRegistration::count();
        
        // Settings for base amount
        $setting = MosqueSetting::first();
        if ($setting) {
             
        }

        return view('admin.dashboard', compact('chartLabels', 'chartData', 'totalDonors', 'totalRaised', 'totalCommunity', 'totalClassRegistrations'));
    }
}
