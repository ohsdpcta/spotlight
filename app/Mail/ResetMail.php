<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $data;
    protected $data_token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$data_token)
    {
        $this->data = $data;
        $this->data_token = $data_token;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('emails.resetmail')
            ->subject('【Spotlight】パスワードリセットメール')
            ->with(['emaildata' => $this->data,'email_token' => $this->data_token]);
    }
}
