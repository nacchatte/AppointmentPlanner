<?php

namespace App\Http\Controllers\Backend;

use App\Models\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {

        // Get the current month and year from the URL parameters
        $currentMonth = $request->input('month') ?? date('m');
        $currentYear = $request->input('year') ?? date('Y');
        // Get a range of available months and years
        $availableMonths = $this->getMonthRange();
        $availableYears = $this->getYearRange();

        // Fetch sales analytics
        $completedAppointments = Appointment::where('App_Status', 'completed')
            ->whereMonth('App_Date', $currentMonth)
            ->whereYear('App_Date', $currentYear)
            ->count();

        $totalEarnings = Appointment::where('App_Status', 'completed')
            ->whereMonth('App_Date', $currentMonth)
            ->whereYear('App_Date', $currentYear)
            ->sum('App_Price');

        $upcomingAppointments = Appointment::where('App_Status', 'upcoming')
            ->whereMonth('App_Date', $currentMonth)
            ->whereYear('App_Date', $currentYear)
            ->count();

        $cancelledAppointments = Appointment::where('App_Status', 'cancelled')
            ->whereMonth('App_Date', $currentMonth)
            ->whereYear('App_Date', $currentYear)
            ->count();

        // Get the first and last day of the month
        $firstDayOfMonth = date('Y-m-01', strtotime("$currentYear-$currentMonth-01"));
        $lastDayOfMonth = date('Y-m-t', strtotime("$currentYear-$currentMonth-01"));

        // Generate an array of dates from the first to the last day of the month
        $dateRange = [];
        $currentDate = $firstDayOfMonth;
        while ($currentDate <= $lastDayOfMonth) {
            $dateRange[] = $currentDate;
            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        }

        // Fetch earnings data
        $earningsData = Appointment::where('App_Status', 'completed')
            ->whereMonth('App_Date', $currentMonth)
            ->whereYear('App_Date', $currentYear)
            ->groupBy('App_Date')
            ->selectRaw('App_Date as date, sum(App_Price) as earnings')
            ->get();

        // Create an associative array to map dates to earnings
        $earningsMap = $earningsData->pluck('earnings', 'date')->toArray();

        // Fill in earnings for each date in the range, defaulting to 0 if no earnings data
        $chartSeries = array_map(function ($date) use ($earningsMap) {
            return $earningsMap[$date] ?? 0;
        }, $dateRange);

        // Convert the $dateRange array to an array suitable for Chartist.js
        $chartLabels = $dateRange;
        //dd($chartLabels, $chartSeries);
        return view(
            'Backend.dashboard',
            compact(
                'completedAppointments',
                'totalEarnings',
                'upcomingAppointments',
                'cancelledAppointments',
                'chartLabels', // Pass the labels to the view
                'chartSeries',  // Pass the series data to the view
                'availableMonths',
                'availableYears',
                'currentMonth',
                'currentYear'
            )
        );
    }

    private function getMonthRange()
    {
        $months = Appointment::select(DB::raw('DISTINCT MONTH(App_Date) as month'))
            ->orderBy('month', 'asc')
            ->get()
            ->map(function ($item) {
                return [
                    'number' => str_pad($item->month, 2, '0', STR_PAD_LEFT),
                    'name' => date('F', strtotime("2022-$item->month-01")),
                ];
            })
            ->toArray();

        return $months;
    }

    private function getYearRange()
    {
        $years = Appointment::select(DB::raw('DISTINCT YEAR(App_Date) as year'))
            ->orderBy('year', 'desc')
            ->get()
            ->pluck('year')
            ->toArray();

        return $years;
    }


    public function updateAnalytics($selectedYear, $selectedMonth)
    {
        // Get the current month and year from the URL parameters
        $currentMonth = $selectedMonth;
        $currentYear = $selectedYear;
        // Get a range of available months and years
        $availableMonths = $this->getMonthRange();
        $availableYears = $this->getYearRange();

        $completedAppointments = Appointment::where('App_Status', 'completed')
            ->whereMonth('App_Date', $currentMonth)
            ->whereYear('App_Date', $currentYear)
            ->count();

        $totalEarnings = Appointment::where('App_Status', 'completed')
            ->whereMonth('App_Date', $currentMonth)
            ->whereYear('App_Date', $currentYear)
            ->sum('App_Price');

        $upcomingAppointments = Appointment::where('App_Status', 'upcoming')
            ->whereMonth('App_Date', $currentMonth)
            ->whereYear('App_Date', $currentYear)
            ->count();

        $cancelledAppointments = Appointment::where('App_Status', 'cancelled')
            ->whereMonth('App_Date', $currentMonth)
            ->whereYear('App_Date', $currentYear)
            ->count();

        // Get the first and last day of the month
        $firstDayOfMonth = date('Y-m-01', strtotime("$currentYear-$currentMonth-01"));
        $lastDayOfMonth = date('Y-m-t', strtotime("$currentYear-$currentMonth-01"));

        // Generate an array of dates from the first to the last day of the month
        $dateRange = [];
        $currentDate = $firstDayOfMonth;
        while ($currentDate <= $lastDayOfMonth) {
            $dateRange[] = $currentDate;
            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        }

        // Fetch earnings data
        $earningsData = Appointment::where('App_Status', 'completed')
            ->whereMonth('App_Date', $currentMonth)
            ->whereYear('App_Date', $currentYear)
            ->groupBy('App_Date')
            ->selectRaw('App_Date as date, sum(App_Price) as earnings')
            ->get();

        // Create an associative array to map dates to earnings
        $earningsMap = $earningsData->pluck('earnings', 'date')->toArray();

        // Fill in earnings for each date in the range, defaulting to 0 if no earnings data
        $chartSeries = array_map(function ($date) use ($earningsMap) {
            return $earningsMap[$date] ?? 0;
        }, $dateRange);

        // Convert the $dateRange array to an array suitable for Chartist.js
        $chartLabels = $dateRange;
        //dd($chartLabels, $chartSeries);
        // Return only the data as JSON
        return response()->json([
            'completedAppointments' => $completedAppointments,
            'totalEarnings' => $totalEarnings,
            'upcomingAppointments' => $upcomingAppointments,
            'cancelledAppointments' => $cancelledAppointments,
            'chartLabels' => $chartLabels,
            'chartSeries' => $chartSeries,
        ]);
    }
}
