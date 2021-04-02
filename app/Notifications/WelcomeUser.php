<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use App\User;

class WelcomeUser extends Notification
{
    use Queueable;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;


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

       // $from_email = env('MAIL_FROM_ADDRESS');
        //dd($from_email);
        $from_email = 'system@estisharh.com';

        if($this->user->roles->first()->name == 'patient' ||$this->user->roles->first()->name == 'doctor')
        {
            
            return (new MailMessage)
                ->from($from_email)
                ->subject('Welcome to Eclinic Application')
                ->greeting('Hello '.$this->user->first_name.' '.$this->user->last_name.',')
                 ->line('Welcome to Eclinic Thank you for registration with Eclinic application. <b> Your login details are as follow:</b>') 
                ->line('Email : ' .$this->user->email.'<br>Password: ' .$this->user->mobile)
                //->line('Password :'.$this->user->mobile)
                ->line('Regards,<br>Eclinic')
                ->line('Thank you for using Eclinic application!');

        return (new MailMessage)
                ->from($from_email)
                ->subject('Welcome email to user')
                ->greeting('Hello '.$this->user->first_name.' '.$this->user->last_name)
                ->line('Welcome to Eclinic Thank you for registration into omnee application. Regards, Eclinic ') 
                ->line('Thank you for using our application!');    

            }
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
