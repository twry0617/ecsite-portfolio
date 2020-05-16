<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

 /**
     * @param bool $employeeCheckStatus
     * @param bool $ManagerCheckStatus
     * @param bool $presidentkStatus
     * @return bool
     */
    public function func1(bool $employeeCheckStatus,
                          bool $ManagerCheckStatus,
                          bool $presidentkStatus
    ): bool
    {
        // 社長チェックOKの場合
        if ($presidentkStatus === true) {
            $result = true;
            return $result;
        }
        // 課長チェックOKの場合
        if ($ManagerCheckStatus === true) {
            $result = false;
            return $result;
        }
        // 社員チェックOKの場合
        if ($employeeCheckStatus === true) {
            $result = false;
            return $result;
        }
    }
}
