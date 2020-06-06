<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailVerification;

class EmailVerify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Supplierインスタンス
     *
     * @var EmailVerification
     */
    protected $emailVerification;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailVerification)
    {
        $this->emailVerification = $emailVerification;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('新規登録リンク')
                    ->view('mail.pre_register')
                    ->with(['token' => $this->emailVerification->token]);
    }
}
