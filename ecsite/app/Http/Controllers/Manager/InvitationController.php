<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Supplier;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\Log;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PreInvitationRegister;

class InvitationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * middlewareの設定
     */
    public function __construct()
    {
        $this->middleware('auth:manager');
    }

    /**
     * 招待フォーム
     *
     * @return view
     */
    public function emailVerificationForm()
    {
        return view('manager.auth.invitation');
    }

    /**
     * 仮登録
     *
     * @param PreInvitationRegister $request
     * @param EmailVerification $emailVerification
     * @return view
     */
    public function emailVerification(PreInvitationRegister $request, EmailVerification $emailVerification)
    {
        $emailVerification = EmailVerification::build($request->email);
        DB::beginTransaction();
        try {
            $emailVerification->saveOrFail();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::warning("メールアドレス変更処理に失敗しました。 {$e->getMessage()}", $e->getTrace());
            return back()
                ->with([
                    'email' => $request->email
                ])->withErrors(['error' => 'メールアドレスの登録に失敗しました。']);
        }
        Mail::to($request->email)->send(new \App\Mail\EmailVerify($emailVerification));

        return back()->with('flash_message', '招待メールを送りました');
    }
}
