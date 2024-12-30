<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class upcomingApp extends Notification
{
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Reminder: Your appointment is scheduled for tomorrow.')
            ->line('Date: ' . $notifiable->appointment->App_Date)
            ->line('Time: ' . $notifiable->appointment->App_Time)
            ->action('View Appointment', url('/appointments/' . $notifiable->appointment->App_Id))
            ->line('Thank you for using our services!');
    }

    public function toDatabase($notifiable)
    {
        // Save the notification to the database (optional)
        return [
            'message' => $this->message,
        ];
    }
}
