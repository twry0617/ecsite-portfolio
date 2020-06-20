<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailVerification;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * EmailVerificationインスタンス
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
        return $this->subject('店舗登録申請が届きました。')
                    ->from($this->emailVerification->email)
                    ->view('mail.invitation')
                    ->with(['token' => $this->emailVerification->token]);
    }
}
