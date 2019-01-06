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
        $reserveringen = Reservering::where('datum','=', Carbon::today())->with('tafels')->get();

        return view('home',compact(['reserveringen']));
    }
    public function changeReserveringDate(Request $request) {
        $adjustedTime = Carbon::parse($request['datum'])->format('Y-m-d 00:00:00');
        $reserveringen = Reservering::where('datum','=',$adjustedTime)->get();

        foreach($reserveringen as $reservering){
           $reservering['start_tijd'] = Carbon::parse($reservering['start_tijd'])->format('H:m');
           dd($reservering);
        }
        return view('home',compact(['reserveringen']));
    }
}
