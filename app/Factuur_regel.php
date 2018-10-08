<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Product;

class Factuur_regel extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reservering_id','product', 'prijs', 'hoeveelheid'
    ];

    public function rules()
    {
        return [
            'naam' => 'required',
            'prijs' => 'required',
            'hoeveelheid' => 'integer|required',
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
    public function reserverings()
    {
        return $this->belongsTo('App\Reservering');
    }
}
