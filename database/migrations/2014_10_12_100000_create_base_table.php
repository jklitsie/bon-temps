<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateBaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Menu en product-gerechten
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('naam');
            $table->string('omschrijving');
            $table->integer('gangen');
            $table->boolean('actief')->default(1);
            $table->decimal('prijs');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('naam');
            $table->string('omschrijving');
            $table->decimal('prijs');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('menu_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id');
            $table->integer('product_id');
            $table->integer('gang');
            $table->integer('volgorde');
            $table->timestamps();
        });

        Schema::create('factuur_regels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product');
            $table->decimal('prijs');
            $table->decimal('hoeveelheid');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('tafels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tafel_nummer');
            $table->integer('stoelen');
            $table->timestamps();
        });

        Schema::create('reserverings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('klant_id');
            $table->integer('tafel_id');
            $table->integer('menu_id');
            $table->dateTime('datum');
            $table->time('start_tijd');
            $table->integer('groepsgroote');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('klants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voornaam');
            $table->string('achternaam');
            $table->string('email');
            $table->string('telefoonnummer');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('allergieëns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('naam');
            $table->string('icon');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('allergieën_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('allergieën_id');
            $table->integer('product_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
}
