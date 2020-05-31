<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EmailVerification extends Model
{
    /**
     * 仮会員登録のメール送信
     */
    const SEND_MAIL = 0;

    /**
     * メールアドレス認証
     */
    const MAIL_VERIFY = 1;
    /**
     * 本会員登録完了
     */
    const REGISTER = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'token', 'status', 'expiration_datetime',
    ];

    /**
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public static function findByToken($token)
    {
        return self::where('token', '=', $token)->first();
    }

    public function mailVerify()
    {
        $this->status = self::MAIL_VERIFY;
    }

    public function isRegister()
    {
        return $this->status === self::REGISTER;
    }

    public function register()
    {
        $this->status = self::REGISTER;
    }

    /**
     * EmailVerificationインスタンス生成
     *
     * @param $email
     * @param integer $hours
     * @return EmailVerification
     */
    public static function build($email, $hours = 1)
    {
        $emailVerification = new self([
            'email' => $email,
            'token' => str_random(250),
            'status' => self::SEND_MAIL,
            'expiration_datetime' => Carbon::now()->addHours($hours),
        ]);
        return $emailVerification;
    }
}
