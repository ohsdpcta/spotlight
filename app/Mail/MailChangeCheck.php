<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailChangeCheck extends Mailable
{
    use Queueable, SerializesModels;

    protected $email_data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_data)
    {

        $this->email_data = $email_data;
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
            ->with(['email_token'=>$this->email_data]);
    }
}
