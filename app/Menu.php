<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Product;

class Menu extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'naam', 'omschrijving', 'prijs', 'gangen'
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
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $hidden = [

    ];

    // Relationships
    public function products()
    {
        return $this->belongsToMany('App\Product', 'menu_product')->withPivot('gang');
    }
    public function reserverings()
    {
        return $this->belongsToMany('App\Reservering');
    }
}
