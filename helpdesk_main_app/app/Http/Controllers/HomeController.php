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
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $activePage = '';
        $activeButton = '';
        $navName = '';

        if (
            1 == 1
            && auth()->check()
        ) {

            $activePage = 'home';
            $activeButton = 'home';
            $navName = 'home';
            return view('home')->with('activePage', $activePage)->with('activeButton', $activeButton)->with('navName', $navName);
        } else {

            $activePage = 'welcome';
            $activeButton = 'welcome';
            $navName  = 'welcome';

            return view('welcome')->with('activePage', $activePage)->with('activeButton', $activeButton)->with('navName', $navName);

            // return redirect()->route('welcome')->with('activePage', $activePage)->with('activeButton', $activeButton)->with('navName', $navName);
        }
    }
}
