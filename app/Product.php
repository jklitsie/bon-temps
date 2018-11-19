<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Menu;

class Product extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'naam', 'omschrijving', 'prijs',
    ];

    public function rules()
    {
        return [
            'naam' => 'required|string|min:0|max:64',
            'omschrijving' => 'required|string|min:0|max:128',
            'prijs' => 'required|integer',
        ];
    }
    /**
     *
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $hidden = [

    ];
    // Relationships
    public function menus(){
        return $this->belongsToMany('App\Menu','menu_product');
    }
    public function allergieëns(){
        return $this->BelongsToMany('App\Allergieën','allergieën_product');
    }
}
