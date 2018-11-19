<?php

namespace App\Http\Controllers;

use App\Allergieën;
use App\Product;
use App\Menu;
use Illuminate\Http\Request;
use Validator;
class productController extends Controller
{
    //Index van alle producten
   public function index()
    {
        $products = Product::all();
        return view('product/index', compact(['products']));
    }
    // Returned view om een nieuw product aan te maken
    public function showCreateNewProduct(){
       $allergieën = Allergieën::all();
       return view('product/newproduct',compact(['allergieën']));
    }
    //Verwerkt Post van een nieuwe product
    public function createNewproduct(Request $request){
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
        if($request->allergieën){
            foreach($request->allergieën as $allergie){
                $product->allergieëns()->attach($allergie);
            }
        }
       return redirect()->route('products');
    }
    //Showed het product en alle Allergieën in
    public function showProduct(Product $product)
    {
        $allergieën = Allergieën::all();
        $bestaandeAllergieën = $product->allergieëns()->get();
        $checkArray = [];
        foreach($bestaandeAllergieën as $allergie){
            $checkArray[] = $allergie->id;
        }
       return view('product.showproduct', compact(['product','allergieën','checkArray']));
    }
    //Verwerkt Post van de bewerking van een bestaande product

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
               if(! $product->allergieëns()->where('allergieën_id',$allergie)->exists()){
                   $product->allergieëns()->attach($allergie);
               }
           }
        }
       $product->update($attributes);
        return redirect()->back();
    }
    //Delete product met #id
    public function removeProduct(Product $product){
       $product->allergieëns()->detach();
       $product->delete();
       return redirect()->back();
    }
}
