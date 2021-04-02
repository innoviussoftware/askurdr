<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use App\User;

class PatientBooking extends Notification
{
    use Queueable;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$doctor,$doctor_booking,$appointment_time)
    {
        $this->user = $user;
        $this->doctor = $doctor;
        $this->doctor_booking = $doctor_booking;
        $this->appointment_time = $appointment_time;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // New create user welcome mail template

     //   $from_email = env('MAIL_FROM_ADDRESS');
         $from_email = 'appointment@estisharh.com';
        return (new MailMessage)
                ->from($from_email)
                ->subject('Booking an appointment')
                ->greeting('Hello '.$this->user->first_name.' '.$this->user->last_name.',')
                ->line('Welcome to Eclinic!')
                ->line('Your appointment date and time with '.$this->doctor->first_name.''.date('d-m-Y',strtotime($this->doctor_booking->date)).' : '.$this->appointment_time)
                ->line('Thank you for  booking an appointment!')
                ->line('Regards,<br>Eclinic');


    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
