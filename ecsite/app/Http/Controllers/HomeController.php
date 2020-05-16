<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return void
     */
    public function index(int $id)
    {
        return view('home');
    }
}
