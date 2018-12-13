<?php

namespace App\Http\Controllers;

use App\Tafel;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use DB;

class TafelController extends Controller
{
    public function returnIndex()
    {
        return view('tafel/index');
    }

    public function index()
    {
        $allTafels = Tafel::all();
        return response()->json($allTafels, 200);
    }

    public function createTafel(Request $request)
    {
        $tafel = new Tafel();
        $tafel->tafel_nummer = $request->tafel_nummer;
        $tafel->stoelen = $request->stoelen;
        $tafel->save();
        return $tafel;
    }

    public function editTafel(Request $request, Tafel $tafel)
    {
        $tafel->tafel_nummer = $request->tafel_nummer;
        $tafel->stoelen = $request->stoelen;
        $tafel->update();
        return $tafel;
    }

    public function deleteTafel(Request $request, Tafel $tafel)
    {
        if ($tafel->tafel_nummer == $request->tafel_nummer) {
            $tafel->delete();
            return 'succes';
        } else {
            return 'something went wrong';
        }
    }

    public function getTafelsBetweenTime(Request $request)
    {
        // datetime and datetime+2 uur
        // where datum >= datetime
        // Zit er al iemand voor mij op de tafel?
        $startTijd = (Carbon::parse($request->datum))->subHours(2)->toDateTimeString();
        // Eigen tijd
        $middentijd = (Carbon::parse($request->datum))->toDateTimeString();
        // Zit er al iemand na mijn start tijd op de tafel
        $eindTijd = (Carbon::parse($request->datum))->addHours(2)->toDateTimeString();
        $tafels = DB::table('reservering_tafel')
            ->select('tafel_id')
            ->where('datum', '>=', $startTijd)
            ->where('datum', '<=', $middentijd)
            ->orWhere('datum', '>=', $middentijd)
            ->where('datum', '<=', $eindTijd)
            ->groupBy('tafel_id')
            ->pluck('tafel_id');
        return $tafels;
    }
}
