<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use App\Models\Appointment;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SalesReportMail extends Mailable
{
    use Queueable, SerializesModels;
    public $pdfPath;
    public $month;
    public $year;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdfPath)
    {
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        $monthYear = $this->getMonthYearFromPdfPath();
        return $this->view('Backend.sales-email', ['monthYear' => $monthYear]) // Ensure the correct view name
            ->attach($this->pdfPath)
            ->subject("Sales Report - {$monthYear}");
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    // public function envelope()
    // {   
    //     return new Envelope(
    //         subject: 'Sales Report',
    //     );
    // }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    // public function content()
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
    private function getMonthYearFromPdfPath()
    {
        // Extract month and year from the PDF path
        $pathParts = pathinfo($this->pdfPath);
        $filename = $pathParts['filename'];

        // Assuming the filename is in the format "sales-report-MM-YYYY"
        $matches = [];
        if (preg_match('/(\d{2})-(\d{4})/', $filename, $matches)) {
            $month = $matches[1];
            $year = $matches[2];

            // Format the month and year (you can customize this as needed)
            $formattedMonth = date('F', mktime(0, 0, 0, $month, 1));
            return "{$formattedMonth} {$year}";
        }

        // If the filename format is not as expected, return a default value
        return 'Unknown Month Year';
    }
}
