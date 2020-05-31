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
     * 本登録のバリデーション
     *
     * @param array $data
     * @return Validator
     */
    protected function create_validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * 招待フォーム
     *
     * @return view
     */
    public function emailVerificationForm()
    {
        return view('supplier.auth.invitation');
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
            return view('supplier.auth.invitation')
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
     * @param Request $request
     * @param string $token
     * @return view
     */
    protected function create(Request $request, string $token)
    {
        $validator = $this->create_validator($request->all());
        if ($validator->fails()) {
            return view('supplier.auth.register')
                ->with([
                    'token' => $request->token,
                    'name' => $request->name,
                ])
                ->withErrors($validator);
        } else {
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
}
