<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('menu')->group(function () {
    Route::get('/', 'MenuController@Index')->name('menus');
    Route::get('/newMenu', 'MenuController@showCreateNewMenu')->name('newMenu');
    Route::post('/newMenu', 'MenuController@createNewMenu')->name('createMenu');
    Route::get('/{menu}', 'MenuController@showMenu')->name('showMenu');
    Route::get('/{menu}/toggle', 'MenuController@toggleMenu')->name('menuToggle');
    Route::put('/{menu}', 'MenuController@editMenu')->name('editMenu');
    Route::get('/{menu}/delete', 'MenuController@removeMenu')->name('deleteMenu');
    Route::get('/{menu}/add', 'MenuController@showMenuProducts')->name('showAddProductMenu');
    Route::get('/{menu}/{product}/delete', 'MenuController@deleteProductFromMenu')->name('deleteProductFromMenu');
    Route::post('/{menu}/{product}', 'MenuController@addMenuProduct')->name('addProductMenu');
});
Route::prefix('product')->group(function () {
    Route::get('/', 'ProductController@Index')->name('products');
    Route::get('/new', 'ProductController@showCreateNewProduct')->name('newProduct');
    Route::post('/new', 'ProductController@createNewProduct')->name('createProduct');
    Route::get('/{product}', 'ProductController@showProduct')->name('showProduct');
    Route::put('/{product}', 'ProductController@editProduct')->name('editProduct');
    Route::get('/{product}/delete', 'ProductController@removeProduct')->name('deleteProduct');
});
Route::prefix('klant')->group(function () {
    Route::get('/', 'KlantController@Index')->name('klanten');
    Route::get('/new', 'KlantController@showCreateNewKlant')->name('newKlant');
    Route::post('/new', 'KlantController@createNewKlant')->name('createKlant');
    Route::get('/export','KlantController@exportKlanten')->name('exportKlant');
    Route::get('/{klant}', 'KlantController@showKlant')->name('showKlant');
    Route::put('/{klant}', 'KlantController@editKlant')->name('editKlant');
    Route::get('/{klant}/delete', 'KlantController@removeKlant')->name('deleteKlant');

});
Route::prefix('reservering')->group(function () {
    Route::get('/','ReserveringController@index')->name('reserveringen');
    Route::get('/new', 'ReserveringController@showNewReservering')->name('newReservering');
    Route::post('/new', 'ReserveringController@newReservering')->name('newReservering');
    Route::get('/searchKlanten/{klantnaam}', 'ReserveringController@searchKlanten')->name('searchKlanten');
});

