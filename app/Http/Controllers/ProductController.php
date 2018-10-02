<?php

namespace App\Http\Controllers;

use App\Allergieën;
use App\Product;
use App\Menu;
use Illuminate\Http\Request;
use Validator;
class productController extends Controller
{
   public function index()
    {
        $products = Product::all();
        return view('product/index', compact(['products']));
    }
    public function showCreateNewProduct(){
       $allergieën = Allergieën::all();
       return view('product/newproduct',compact(['allergieën']));
    }
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
        foreach($request->allergieën as $allergie){
            $product->allergieëns()->attach($allergie);
        }
       return redirect()->route('products');
    }

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
    }
}
