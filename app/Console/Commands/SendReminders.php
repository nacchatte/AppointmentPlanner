<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\User;
use App\Notifications\upcomingApp;
use Illuminate\Console\Command;

class SendReminders extends Command
{
    protected $signature = 'send:reminders';
    protected $description = 'Send appointment reminders';

    public function handle()
    {
        // Fetch appointments that are one day ahead
        $appointments = Appointment::select(
            'appointments.App_Id',
            'appointments.App_Date',
            'appointments.App_Time',
            'appointments.App_Duration',
            'appointments.App_Price',
            'appointments.App_Desc',
            'appointments.App_Status',
            'appointments.Customer_Id',
            'customer.Customer_Name',
            'customer.Customer_HP',
            'customer.Customer_Address',
        )
            ->join('customer', 'appointments.Customer_Id', '=', 'customer.Customer_Id')
            ->whereDate('App_Date', now()->addDay())
            ->get();
        //$appointments = Appointment::whereDate('App_Date', now()->addDay())->get();

        // Fetch all users (modify the query as needed)
        $users = User::all();

        foreach ($users as $user) {
            foreach ($appointments as $appointment) {
                // Customize the notification message as per your requirements
                $message = "Reminder: Your appointment is tomorrow at {$appointment->App_Time} for {$appointment->Customer_Name} at {$appointment->Customer_Address}.";

                // Save the notification to the database
                $user->notifications()->create([
                    'message' => $message,
                ]);

                // Send the notification via email (you can customize this for other channels)
                $user->notify(new upcomingApp($message));
            }
        }

        $this->info('Reminders sent successfully.');
    }
}
