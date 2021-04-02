<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use App\User;
use App\Job;
use App\City;
use App\State;
use App\Company;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $current_user = auth()->user();
        // if ($current_user->can([Config::get('constants.modules.DASHBOARD')]) == false) {
        //     return view('admin.welcome_omnee');
        // }

        return view('admin.index');
    }
}
