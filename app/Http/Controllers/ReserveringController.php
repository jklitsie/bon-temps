<?php

namespace App\Http\Controllers;

use App\Allergieën;
use App\Klant;
use App\Product;
use App\Menu;
use App\Reservering;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Http\Response;

class ReserveringController extends Controller
{
    public function index($reservering = false)
    {
        if ($reservering) {
            $data = Klant::all(['id', 'achternaam']);
            $menuGet = Menu::all(['id', 'naam']);
            $menus = [];
            $klanten = [];
            foreach ($data as $klant) {
                $klanten[$klant->id] = $klant->achternaam;
            }
            foreach ($menuGet as $menu) {
                if($menu->actief == 1){
                    $menus[$menu->id] = $menu->naam;
                }
            }
            $reservering = Reservering::find($reservering);
            $reservering_menu = $reservering->menus()->get();
            $reservering['datum'] = $reservering->getCreatedDateForReservering($reservering['datum']);
            $count = microtime(false);
            return view('reservering/showReservering', compact(['reservering', 'klanten', 'menus', 'reservering_menu', 'count']));
        } else {
            $reserveringen = Reservering::paginate(15);
            foreach ($reserveringen as $reservering) {
                $reservering['datum'] = $reservering->getCreatedAtAttribute($reservering['datum']);
                $reservering['start_tijd'] = $reservering->getProperTime($reservering['start_tijd']);
                $reservering['eind_tijd'] = $reservering->getProperTime($reservering['eind_tijd']);
            }
            return view('reservering/index', compact(['reserveringen']));
        }
    }

    public function showNewReservering()
    {
        $data = Klant::all(['id', 'achternaam']);
        $menuGet = Menu::all(['id', 'naam']);
        $menus = [];
        $klanten = [];
        foreach ($data as $klant) {
            $klanten[$klant->id] = $klant->achternaam;
        }
        foreach ($menuGet as $menu) {
            $menus[$menu->id] = $menu->naam;
        }
        return view('reservering/newReservering', compact(['klanten', 'menus']));
    }

    public function newReservering(Request $request)
    {
        $reservering = new Reservering();
        $attributes = $request->except('_token', 'menu_id', 'menu_hoeveelheid');
        $validator = Validator::make($attributes, $reservering->rules());
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $reservering = Reservering::create($attributes);
        $reservering->menus()->attach($request->pocket);
        return redirect()->route('reserveringen');
    }

    public function editReservering(Reservering $reservering, Request $request)
    {

        $attributes = $request->except('_token', 'menu_id', 'menu_hoeveelheid');
        $validator = Validator::make($attributes, $reservering->rules());
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $reservering->update($attributes);
        if($request->pocket) {
            foreach ($request->pocket as $pocket) {
                if (!$reservering->menus()->where('menu_id', '=', $pocket['menu_id'])->exists()) {
                    $reservering->menus()->attach($request->pocket);
                } else {
                    $menu = array(
                        'menu_hoeveelheid' => $pocket['menu_hoeveelheid'],
                    );
                    $reservering->menus()->updateExistingPivot($pocket['menu_id'], $menu);
                }
            }
        }
        return redirect()->back();
    }

    public function removeReservering(Reservering $reservering)
    {
        if($reservering->menus()->get()){
            $reservering->menus()->detach();
        }
        $reservering->delete();
        return redirect()->back();
    }


    public function searchKlanten($klantnaam)
    {
        $klanten = Klant::where('voornaam', 'LIKE', '%' . $klantnaam . '%')->get();

        return response()->json([
            'status' => 'ok',
            'klanten' => $klanten
        ]);
    }

    public function ajaxExtraMenu()
    {
        $menus = Menu::all();
        return response()->json(['html' => \View::make('partials/extra_menu', compact('menus'))->render()]);
    }

    public function deleteMenu(Reservering $reservering, $menu)
    {
        $reservering->menus()->wherePivot('menu_id', '=', $menu)->detach();
        return redirect()->back();
    }
}
