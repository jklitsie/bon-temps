<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Menu;
use App\Tafel;
use App\Klant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservering extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'klant_id', 'datum', 'start_tijd','eind_tijd','groepsgroote','betaald'
    ];

    public function rules()
    {
        return [
            'klant_id'=> 'required|integer',
            'datum' => 'required|date',
            'start_tijd' => 'required',
            'eind_tijd' => 'required',
            'groepsgroote' => 'required|integer'
        ];
    }
    /**
     *
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function getProperTime($value)
    {
        $date = Carbon::parse($value);
        return $date->format('H:i');
    }
    public function getCreatedAtAttribute($value)
    {
        $date = Carbon::parse($value);
        return $date->format('d-m-Y');
    }
    public function getCreatedDateForReservering($value)
    {
        $date = Carbon::parse($value);
        return $date->format('Y-m-d');
    }
    protected $hidden = [

    ];
    protected $appends = [
      'tafels'
    ];
    // Relationships
    public function klant(){
        return $this->belongsTo('App\Klant');
    }
    public function factuurregels(){
        return $this->hasMany('App\Factuur_regel');
    }
    public function menus(){
        return $this->belongsToMany('App\Menu','reservering_menu')->withPivot('menu_hoeveelheid');
    }
    public function tafels(){
        return $this->belongsToMany('App\Tafel','reservering_tafel');
    }
//    public function tafel(){
//        return $this->HasOne('App\Tafel');
//    }
}
