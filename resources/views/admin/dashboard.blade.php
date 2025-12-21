@extends('admin.layout')

@section('title','Dashboard')

@section('content')
<div class="grid grid-cols-1 gap-6 mb-6">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <h3 class="text-2xl font-semibold text-slate-900 mb-2">Welcome back! 👋</h3>
        <p class="text-slate-600">Here's what's happening with your mosque community today.</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- Stat Card: Donors -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-blue-50 rounded-lg text-blue-600">
                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Total Online Donors</p>
                <h4 class="text-xl font-bold text-slate-900">{{ number_format($totalDonors) }}</h4>
            </div>
        </div>
    </div>
     <!-- Stat Card: Raised -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-green-50 rounded-lg text-green-600">
                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Total Donation Raised</p>
                <h4 class="text-xl font-bold text-slate-900">${{ number_format($totalRaised, 2) }}</h4>
            </div>
        </div>
    </div>
    <!-- Stat Card: Community -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-purple-50 rounded-lg text-purple-600">
                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Community Joined</p>
                <h4 class="text-xl font-bold text-slate-900">{{ number_format($totalCommunity) }}</h4>
            </div>
        </div>
    </div>
     <!-- Stat Card: Class Reg -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-orange-50 rounded-lg text-orange-600">
                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Class Registrations</p>
                <h4 class="text-xl font-bold text-slate-900">{{ number_format($totalClassRegistrations) }}</h4>
            </div>
        </div>
    </div>
</div>

<!-- Donation Chart -->
<div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
    <div class="flex justify-between items-center mb-6">
        <h3 class="font-bold text-slate-900 text-lg">Online Donation Trends (Last 12 Months)</h3>
    </div>
    <div class="h-80 w-full relative">
        <canvas id="donationChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('donationChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Donations ($)',
                    data: @json($chartData),
                    borderColor: '#047857', // emerald-700
                    backgroundColor: (context) => {
                        const ctx = context.chart.ctx;
                        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
                        gradient.addColorStop(0, 'rgba(4, 120, 87, 0.2)');
                        gradient.addColorStop(1, 'rgba(4, 120, 87, 0)');
                        return gradient;
                    },
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#047857',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [4, 4], color: '#f3f4f6' },
                        ticks: { callback: (value) => '$' + value }
                    },
                    x: {
                        grid: { display: false }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: (context) => ' $' + context.parsed.y.toFixed(2)
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
            }
        });
    });
</script>
@endsection
