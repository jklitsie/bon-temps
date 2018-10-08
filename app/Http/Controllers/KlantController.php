<?php

namespace App\Http\Controllers;

use App\ExportKlant;
use App\Klant;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;


class klantController extends Controller
{
   public function index()
    {
        $klanten = Klant::all();
        return view('klant/index', compact(['klanten']));
    }
    public function showCreateNewKlant(){
       return view('klant/newKlant');
    }
    public function createNewKlant(Request $request){

       $klant = new klant();
       $attributes = $request->except('_token');
       $validator = Validator::make($attributes, $klant->rules());
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
       Klant::create($attributes);
       return redirect()->route('klanten');
    }

    public function showKlant(Klant $klant){
       return view('klant.showKlant', compact(['klant']));
    }
    public function editKlant (Klant $klant, Request $request){

        $attributes = $request->except('_token');

        $validator = Validator::make($attributes, $klant->rules());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
       $klant->update($attributes);
        return redirect()->back();
    }

    public function removeProduct(Klant $klant)
    {
        $klant->delete();
        return redirect()->back();
    }
    public function exportKlanten()
    {
        return (new ExportKlant(2018))->download('invoices.xlsx');
    }
}
