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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function email_validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:suppliers'],
        ]);
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
     * @param Request $request
     * @param EmailVerification $emailVerification
     * @return view
     */
    public function emailVerification(Request $request, EmailVerification $emailVerification)
    {
        $validator = $this->email_validator($request->all());
        if ($validator->fails()) {
            return view('manager.auth.invitation')
                ->with([
                    'email' => $request->email,
                ])
                ->withErrors($validator);
        } else {
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
}
