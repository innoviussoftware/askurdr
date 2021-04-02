<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;

class MailResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token,$user)
    {
        $this->token = $token;
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
        
        $link = url( "/password/reset/" . $this->token);
        //$link="http://innoviussoftware.com/eclinic/password/reset/".$this->token;
        $emailContent = '<center><a href="'.$link.'" style="border-radius: 2px;text-decoration: none;text-align: center;color: #fff;background-color: #3097D1;padding: 10px 15px;font-size: 13px;">Reset Password</a></center><br>';

        $from_email = env('MAIL_FROM_ADDRESS');

        return (new MailMessage)
                ->from($from_email)
                ->greeting('Hello '.$this->user->first_name.' '.$this->user->last_name.',')
                ->subject('Reset Password Notification')                
                ->line('You are receiving this email because we received a password reset request for your account.<br>')
                ->line('<center><a href="'.$link.'" style="border-radius: 2px;text-decoration: none;text-align: center;color: #fff;background-color: #3097D1;padding: 10px 15px;font-size: 13px;">Reset Password</a></center><br><br>')
                ->line('<p>This password reset link will expire in 60 minutes<br></p>')
                ->line('<p>If you did not request a password reset, no further action is required.<p><br>')
                ->line('<p>Regards,<br>Eclinic<p>')
                ->line('<p>Thank you for using Eclinic application!<p>');

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
