<?php

namespace App\Http\Controllers;

use App\Allergieën;
use App\Factuur_regel;
use App\Klant;
use App\Product;
use App\Menu;
use App\Reservering;
use Illuminate\Http\Request;
use Validator;

class FactuurController extends Controller
{

    public function showFactuur(Reservering $reservering){
        $totaalprijs = 0;
        $reservering['datum'] = $reservering->getCreatedAtAttribute($reservering->datum);
        foreach($reservering->menus()->get() as $menu){
            $totaalprijs = $totaalprijs + ($menu->prijs * $menu->pivot->menu_hoeveelheid);
        }
        foreach($reservering->factuurregels()->get() as $regel){
            $totaalprijs = $totaalprijs + ($regel->prijs * $regel->hoeveelheid);
        }
        return view('reservering/showFactuur',compact(['reservering','totaalprijs']));
    }
    public function newFactuur_regel(Request $request, Reservering $reservering){
        $attributes = $request->except('_token');
        $attributes['reservering_id'] = $reservering->id;
        Factuur_regel::create($attributes);
        return redirect()->back();
    }
    public function factuurBetaald(Reservering $reservering){
        if($reservering->betaald){
            $attributes['betaald'] = false;
        }else{
            $attributes['betaald'] = true;
        }
        $reservering->update($attributes);
//        return redirect()->back();
        return response()->json(['status'=> 'ok']);
    }
}
