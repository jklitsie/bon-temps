<?php

namespace App\Http\Controllers;

use App\Allergieën;
use App\Klant;
use App\Product;
use App\Menu;
use App\Reservering;
use Illuminate\Http\Request;
use Validator;

class ReserveringController extends Controller
{
   public function index($reservering = false)
    {
        if($reservering){
            $reserveringen = Reservering::where('id', '=', $reservering);
        }else{
            $reserveringen = Reservering::paginate(15);
        }

        return view('reservering/index', compact(['reserveringen']));
    }
    public function showNewReservering(){
        $data = Klant::all(['id','achternaam']);
        $klanten = [];
        foreach($data as $klant){
            $klanten[$klant->id] = $klant->achternaam;
        }
        return view('reservering/newReservering',compact(['klanten']));
    }
    public function newReservering(Request $request){

       $product = new product();
       $attributes['naam'] = $request['naam'];
       $attributes['omschrijving'] = $request['omschrijving'];
       $attributes['prijs'] = $request['prijs'];
       $validator = Validator::make($attributes, $product->rules());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
       $product = Product::create($attributes);
        foreach($request->allergieën as $allergie){
            $product->allergieëns()->attach($allergie);
        }

       return redirect()->route('products');
    }
/*
    public function showProduct(Product $product)
    {
        $allergieën = Allergieën::all();

       return view('product.showproduct', compact(['product','allergieën']));
    }
    public function editProduct (Product $product, Request $request){

        $attributes['naam'] = $request['naam'];
        $attributes['omschrijving'] = $request['omschrijving'];
        $attributes['prijs'] = $request['prijs'];

        $validator = Validator::make($attributes, $product->rules());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if($request->allergieën)
        {
           foreach($request->allergieën as $allergie)
           {
               $x = $product->allergieëns()->where('allergieën_id',$allergie)->exists();
               if(!$x){
                   $product->allergieëns()->attach($allergie);
               }
           }
        }
       $product->update($attributes);
        return redirect()->back();
    }
    public function removeProduct(Product $product){
       $product->allergieëns()->detach();
       $product->delete();
       return redirect()->back();
    }*/
    public function searchKlanten($klantnaam){
        $klanten = Klant::where('voornaam','LIKE','%' . $klantnaam . '%')->get();

        return response()->json([
            'status' => 'ok',
            'klanten' => $klanten
        ]);
    }
}
