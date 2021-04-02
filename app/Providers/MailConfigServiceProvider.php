<?php

namespace App\Providers;

use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (\Schema::hasTable('master_email_settings')) {
            $mail = DB::table('master_email_settings')->first();
            if ($mail) //checking if table is not empty
            {
                // $config = array(
                //     'driver'     => $mail->driver,
                //     'host'       => $mail->host,
                //     'port'       => $mail->port,
                //     'from'       => array('address' => $mail->from_address, 'name' => $mail->from_name),
                //     'encryption' => $mail->encryption,
                //     'username'   => $mail->username,
                //     'password'   => $mail->password,
                //     'sendmail'   => '/usr/sbin/sendmail -bs',
                //     'pretend'    => false,
                // );

                $config = array(
                    'driver'     => 'smtp',
                    'host'       => $mail->smtp_host,
                    'port'       => $mail->smtp_port,
                    'from'       => array('address' => $mail->support_email, 'name' => '<Omnee>'),
                    'encryption' => 'tls',                    
                    'username'   => $mail->smtp_user_name,
                    'password'   => $mail->smtp_password,
                    'sendmail'   => '/usr/sbin/sendmail -bs',
                    'pretend'    => false,
                );
                Config::set('mail', $config);
            }
        }
    }
}
