<?php

namespace App\Http\Controllers\Supplier;

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
use App\Http\Requests\InvitationRegister;

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
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::SUPPLIER_HOME;

    /**
     * middlewareの設定
     */
    public function __construct()
    {
        $this->middleware('guest:supplier');
    }

    /**
     * 新規登録後のリダイレクト先
     *
     * @return url
     */
    public function redirectPath()
    {
        return $this->redirectTo;
    }

    /**
     * Guardの認証方法を指定
     *
     * @return void
     */
    protected function guard()
    {
        return Auth::guard('supplier');
    }

    /**
     * 招待フォーム
     *
     * @return view
     */
    public function invitationEmailForm()
    {
        return view('supplier.auth.invitation');
    }

    /**
     * 登録申請
     *
     * @param PreInvitationRegister $request
     * @param EmailVerification $emailVerification
     * @return view
     */
    public function invitationEmail(PreInvitationRegister $request, EmailVerification $emailVerification, $hours = 1)
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
        Mail::to('ecsite@example.com')->send(new \App\Mail\InvitationMail($emailVerification));

        return back()->with('flash_message', '登録申請を行いました');
    }

    /**
     * トークンが有効か確認し、本登録フォームへ遷移させる
     *
     * @param string $token
     * @return view
     */
    public function emailVerifyComplete(string $token)
    {
        // 有効なtokenか確認
        $emailVerification = EmailVerification::findByToken($token);
        if (empty($emailVerification) || $emailVerification->isRegister()) {
            return view('errors.email_verify');
        }

        // ステータスをメール認証済みに変更する
        $emailVerification->mailVerify();
        DB::beginTransaction();
        try {
            // DB更新
            $emailVerification->update();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::warning("メールアドレスの認証に失敗しました: email: {$emailVerification->email}", $e->getTrace());
            return redirect(route('/supplier/invitation'))
                ->with(['message' => 'メールアドレスの認証に失敗しました。管理者にお問い合わせください。']);
        }
        return view('supplier.auth.register')
            ->with(['token' => $emailVerification->token]);
    }

    /**
     * 本登録
     *
     * @param InvitationRegister $request
     * @param string $token
     * @return view
     */
    protected function create(InvitationRegister $request, string $token)
    {
        $emailVerification = EmailVerification::findByToken($token);
        $supplier = Supplier::create([
            'name' => $request->name,
            'email' => $emailVerification->email,
            'password' => Hash::make($request->password),
        ]);
        $emailVerification->register();
        $emailVerification->update();

        $this->guard()->login($supplier);

        return $this->registered($request, $supplier)
        ?: redirect($this->redirectPath());;
    }
}
