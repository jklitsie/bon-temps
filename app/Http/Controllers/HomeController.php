<?php

namespace App\Http\Controllers;

use App\Reservering;
use Illuminate\Http\Request;
use Carbon\Carbon;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reserveringen = Reservering::where('datum','=', Carbon::today())->get();

        return view('home',compact(['reserveringen']));
    }
}
