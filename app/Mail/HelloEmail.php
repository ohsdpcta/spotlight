<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HelloEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $user_token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_token)
    {
        $this->user_token = $user_token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('emails.contact')
            ->subject('【Spotlight】仮登録が完了しました')
            ->with(['user_data'=>$this->user_token]);
    }
}
