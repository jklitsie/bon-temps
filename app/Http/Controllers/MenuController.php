<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Menu;
use App\Product;
use Illuminate\Http\Request;
use Validator;

class MenuController extends Controller
{
   public function index()
    {
        $menus = Menu::paginate(15);
        return view('menu/index', compact(['menus']));
    }
    public function showCreateNewMenu(){
       return view('menu/newMenu');
    }
    public function createNewMenu(Request $request){

       $menu = new Menu();
       $attributes['naam'] = $request['naam'];
       $attributes['omschrijving'] = $request['omschrijving'];
       $attributes['prijs'] = $request['prijs'];
       $attributes['gangen'] = $request['gangen'];
        $validator = Validator::make($attributes, $menu->rules());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
       Menu::create($attributes);
       return redirect()->route('menus');
    }

    public function showMenu(Menu $menu){
       $gangen = $menu->gangen;
       $menu_products = $menu->products()->get();
       $allergieën = [];

       foreach($menu->products()->get() as $product){
           foreach($product->allergieëns as $allergie){
               $allergieën[$allergie->id] = $allergie->naam;
           }
       }
       return view('menu.showmenu', compact(['menu','menu_products','gangen','allergieën']));
    }
    public function editMenu(Menu $menu, Request $request){

        $attributes['naam'] = $request['naam'];
        $attributes['omschrijving'] = $request['omschrijving'];
        $attributes['prijs'] = $request['prijs'];
        $attributes['gangen'] = $request['gangen'];

        $validator = Validator::make($attributes, $menu->rules());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
       $menu->update($attributes);
        return redirect()->back();
    }
    public function removeMenu(Menu $menu){
       $menu->products()->detach();
       $menu->delete();
       return redirect()->back();
    }
    public function showMenuProducts(Menu $menu){
       $menu_products = $menu->products()->get();
       $available = Product::paginate(15);
       $gangen = [];
       for($i = 1; $i <= $menu->gangen;$i++){
           $gangen[$i] = $i;
       }
       return view('menu/menuProducts',compact(['gangen','menu','menu_products','available']));

    }
    public function addMenuProduct(Menu $menu, Product $product, Request $request){
       //check if exists
        $exists = DB::table('menu_product')
            ->where('menu_id','=', $menu->id)
            ->where('product_id', '=', $product->id)
            ->where('gang', '=', $request['gang'])
            ->exists();
        if(!$exists){
            $attributes[] = array(
                'menu_id' => $menu->id,
                'product_id' => $product->id,
                'gang' => $request->gang,
                'volgorde' => 0,

            );
            $menu->products()->attach($attributes);
            return redirect()->back();
        }
        else{
            return response('jammer joh bestaat al');
        }


    }
    public function deleteProductFromMenu(Menu $menu, $product){
        $menu->products()->detach($product);
        return redirect()->back();
    }
    public function ToggleMenu(Menu $menu){
       if($menu->actief == 1){
           $menu->actief->update(0);
       }
    }
}
