<?php

namespace App\Notifications;

use App\Models\AppointmentModel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SendEmailNotification extends Notification
{
    use Queueable;

    public $appointment;
    public $status;

    // Constructor accepts the appointment and status
    public function __construct(AppointmentModel $appointment, $status)
    {
        $this->appointment = $appointment;
        $this->status = $status;
    }

    // Define which channels to use for notification
    public function via($notifiable)
    {
        return ['mail'];
    }

    // Build the email content
    public function toMail($notifiable)
    {
        $subject = '';
        $line = '';
        $actionUrl = '';

        // URL to view the cancelled appointment details (you can adjust this to fit your route)
        if ($this->status === 'Cancelled') {
            $actionUrl = url('/appointments/cancelled/' . $this->appointment->AppointmentID);
        } else {
            $actionUrl = url('/client/appointments');  // Default link for other status updates
        }

        switch ($this->status) {
            case 'Confirm':
                $subject = 'Appointment Confirmed';
                $line = 'Your appointment has been confirmed.';
                break;

            case 'Cancelled':
                $subject = 'Appointment Cancelled';
                $line = 'Your appointment has been cancelled. Please review the details below.';
                break;

            case 'Rescheduled':
                $subject = 'Appointment Rescheduled';
                $line = 'Your appointment has been rescheduled. Please review the updated details below.';
                break;

            default:
                $subject = 'Appointment Update';
                $line = 'Your appointment details have been updated.';
                break;
        }

        return (new MailMessage)
            ->subject($subject)
            ->greeting('Hello ' . $this->appointment->staff->name . ',')
            ->line($line)
            ->line('Appointment Date & Time: ' . $this->appointment->DateTime->format('l, F j, Y h:i A'))
            ->line('Notes: ' . $this->appointment->Notes)
            ->line('Thank you for your attention.')
            ->action('View Appointment', $actionUrl);  // Dynamic action URL for cancelled or rescheduled appointments
    }

    // Return an array representation for database notifications (optional)
    public function toArray($notifiable)
    {
        return [
            'appointment_id' => $this->appointment->AppointmentID,
            'status' => $this->status,
            'date_time' => $this->appointment->DateTime->format('Y-m-d H:i:s'),
            'notes' => $this->appointment->Notes,
        ];
    }
}
