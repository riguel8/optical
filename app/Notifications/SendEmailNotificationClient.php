<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\AppointmentModel;

class SendEmailNotificationClient extends Notification implements ShouldQueue
{
    use Queueable;

    protected $appointment;
    protected $status;
    protected $recipientType;

    public function __construct(AppointmentModel $appointment, $status, $recipientType)
    {
        $this->appointment = $appointment;
        $this->status = $status;
        $this->recipientType = $recipientType;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $actionUrl = '';
        
        // URL to view the cancelled appointment details (you can adjust this to fit your route)
        if ($this->status === 'Cancelled') {
            $actionUrl = url('/staff/appointments/' . $this->appointment->AppointmentID);
            $actionUrl = url('/admin/appointments/' . $this->appointment->AppointmentID);
        } else {
            $actionUrl = url('/client/appointments');  // Default link for other status updates
        }

        $mailMessage = (new MailMessage)
            ->subject($this->getEmailSubject())
            ->greeting($this->getGreeting($notifiable))
            ->line($this->getMessage())
            ->line('Appointment Details:')
            ->line('Patient Name: ' . $this->appointment->patient->complete_name)
            ->line('Date & Time: ' . $this->appointment->DateTime->format('l, F j, Y h:i A'))
            ->line('Contact Number: ' . $this->appointment->patient->contact_number)
            ->line('Gender: ' . $this->appointment->patient->gender)
            ->line('Age: ' . $this->appointment->patient->age)
            ->line('Address: ' . $this->appointment->patient->address);

        if ($this->status === 'New') {
            $mailMessage->line('Status: Pending Approval');
        }

        $mailMessage->action('View Appointment Details', $this->getActionUrl())
            ->line('Thank you for using our service.');

        return $mailMessage;
    }

    protected function getEmailSubject()
    {
        return match($this->status) {
            'New' => 'New Appointment Request - ' . $this->appointment->patient->complete_name,
            'Cancelled' => 'Appointment Cancelled - ' . $this->appointment->patient->complete_name,
            default => 'Appointment Update - ' . $this->appointment->patient->complete_name,
        };
    }

    protected function getGreeting($notifiable)
    {
        return match($this->recipientType) {
            'admin' => 'Dear Admin,',
            'staff' => 'Dear ' . ($notifiable->name ?? 'Staff Member') . ',',
            'clinic' => 'Dear Delin Optical,',
            default => 'Hello,',
        };
    }

    protected function getMessage()
    {
        if ($this->status === 'New') {
            return match($this->recipientType) {
                'admin' => 'A new appointment request requires your attention.',
                'staff' => 'A new appointment has been scheduled and requires review.',
                'clinic' => 'A new appointment request has been received.',
                default => 'A new appointment request has been submitted.',
            };
        }

        return match($this->status) {
            'Cancelled' => 'An appointment has been cancelled.',
            default => 'There has been an update to an appointment.',
        };
    }

    protected function getActionUrl()
    {
        $baseUrl = config('app.url');
        $appointmentId = $this->appointment->AppointmentID;

        return match($this->recipientType) {
            'admin' => url("/admin/appointments/{$appointmentId}"),
            'staff' => url("/staff/appointments/{$appointmentId}"),
            default => url("/client/appointments/{$appointmentId}"),
        };
    }
}