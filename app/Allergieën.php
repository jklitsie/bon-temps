<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Menu;

class Allergieën extends Model
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
            'naam' => 'required',
            'omschrijving' => 'required',
            'prijs' => 'required',
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
    public function products(){
        return $this->BelongsToMany('App\Product','allergieën_product');
    }
}
