<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Mail\SalesReportMail;
use PDF;

class PdfController extends Controller
{
    public function index()
    {
        $availableMonths = $this->getMonthRange();
        $availableYears = $this->getYearRange();

        return view('Backend.sales-view', compact('availableMonths', 'availableYears'));
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
    public function generateSalesReport($month, $year)
    {
        // Fetch sales analytics for the specified month and year
        $totalAppointments = Appointment::whereMonth('App_Date', $month)
            ->whereYear('App_Date', $year)
            ->count();

        $completedAppointments = Appointment::where('App_Status', 'completed')
            ->whereMonth('App_Date', $month)
            ->whereYear('App_Date', $year)
            ->count();

        $totalEarnings = Appointment::where('App_Status', 'completed')
            ->whereMonth('App_Date', $month)
            ->whereYear('App_Date', $year)
            ->sum('App_Price');

        $upcomingAppointments = Appointment::where('App_Status', 'upcoming')
            ->whereMonth('App_Date', $month)
            ->whereYear('App_Date', $year)
            ->count();

        $cancelledAppointments = Appointment::where('App_Status', 'cancelled')
            ->whereMonth('App_Date', $month)
            ->whereYear('App_Date', $year)
            ->count();

        // Generate PDF view
        $pdf = PDF::loadView(
            'Backend.sales-report',
            compact(
                'totalAppointments',
                'completedAppointments',
                'totalEarnings',
                'upcomingAppointments',
                'cancelledAppointments',
                'month',
                'year'
            )
        );

        // Stream the PDF content to the browser
        return $pdf->stream('sales-report.pdf');
    }
    public function downloadPdf($month, $year)
    {
        //fetch sales analytics data
        $totalAppointments = Appointment::whereMonth('App_Date', $month)
            ->whereYear('App_Date', $year)
            ->count();

        $completedAppointments = Appointment::where('App_Status', 'completed')
            ->whereMonth('App_Date', $month)
            ->whereYear('App_Date', $year)
            ->count();

        $totalEarnings = Appointment::where('App_Status', 'completed')
            ->whereMonth('App_Date', $month)
            ->whereYear('App_Date', $year)
            ->sum('App_Price');

        $upcomingAppointments = Appointment::where('App_Status', 'upcoming')
            ->whereMonth('App_Date', $month)
            ->whereYear('App_Date', $year)
            ->count();

        $cancelledAppointments = Appointment::where('App_Status', 'cancelled')
            ->whereMonth('App_Date', $month)
            ->whereYear('App_Date', $year)
            ->count();

        $pdf = PDF::loadView(
            'Backend.sales-report',
            compact(
                'totalAppointments',
                'completedAppointments',
                'totalEarnings',
                'upcomingAppointments',
                'cancelledAppointments',
                'month',
                'year'
            )
        );

        return $pdf->download("sales-report-{$month}-{$year}.pdf");
    }

    public function sendSalesReportEmail(Request $request, $month, $year)
    {
        $userEmail = $request->input('email');

        // Generate the sales report PDF and get the saved path
        $pdfPath = $this->saveSalesReport($month, $year);

        // Send email using the SalesReportMail Mailable
        Mail::to($userEmail)->send(new SalesReportMail($pdfPath));

        return redirect()->back()->with('success', 'Sales report email sent to ' . $userEmail);
    }

    public function saveSalesReport($month, $year)
    {
        // Check if the sales report already exists
        $existingPdfPath = storage_path("app\public\sales-report\sales-report-{$month}-{$year}.pdf");

        if (file_exists($existingPdfPath)) {
            // If it exists, return the path of the existing report
            return $existingPdfPath;
        } else {

            // Fetch sales analytics for the specified month and year
            $totalAppointments = Appointment::whereMonth('App_Date', $month)
                ->whereYear('App_Date', $year)
                ->count();

            $completedAppointments = Appointment::where('App_Status', 'completed')
                ->whereMonth('App_Date', $month)
                ->whereYear('App_Date', $year)
                ->count();

            $totalEarnings = Appointment::where('App_Status', 'completed')
                ->whereMonth('App_Date', $month)
                ->whereYear('App_Date', $year)
                ->sum('App_Price');

            $upcomingAppointments = Appointment::where('App_Status', 'upcoming')
                ->whereMonth('App_Date', $month)
                ->whereYear('App_Date', $year)
                ->count();

            $cancelledAppointments = Appointment::where('App_Status', 'cancelled')
                ->whereMonth('App_Date', $month)
                ->whereYear('App_Date', $year)
                ->count();

            // Generate PDF view
            $pdf = PDF::loadView(
                'Backend.sales-report',
                compact(
                    'totalAppointments',
                    'completedAppointments',
                    'totalEarnings',
                    'upcomingAppointments',
                    'cancelledAppointments',
                    'month',
                    'year'
                )
            );

            $newPdfPath = storage_path("app\public\sales-report\sales-report-{$month}-{$year}.pdf");
            $pdf->save($newPdfPath);

            // Return the saved PDF path
            return $newPdfPath;
        }
    }
}
