<?php

namespace App\Http\Controllers\Manager\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::MANAGER_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:manager')->except('logout');
    }

    /**
     * ログイン後のリダイレクト先
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
        return Auth::guard('manager');
    }

    /**
     * ログイン画面
     *
     * @return void
     */
    public function showLoginForm()
    {
        return view('manager.auth.login');
    }

    /**
     * ログアウト処理
     *
     * @param Request $request
     * @return void
     */
    public function logout(Request $request)
    {
        Auth::guard('manager')->logout();

        return $this->loggedOut($request);
    }

    /**
     * ログアウトした時のリダイレクト先
     *
     * @param Request $request
     * @return void
     */
    public function loggedOut(Request $request)
    {
        return redirect(route('manager.login'));
    }
}
