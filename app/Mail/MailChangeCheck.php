<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailChangeCheck extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    protected $email_data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$email_data)
    {
        $this->user = $user;
        $this->email_data = $email_data;
        logger($this->email_data);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.donemail')
            ->subject('【Spotlight】メールアドレス変更完了メール')
            ->with('user',$this->user,'email_data',$this->email_data);
    }
}
