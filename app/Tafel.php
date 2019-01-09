<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Reservering;

class Tafel extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stoelen','tafel_nummer'
    ];

    public function rules()
    {
        return [
            'stoelen' => 'required','integer',
            'tafel_nummer' => 'required','integer',
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
    public function reserveringen(){
        return $this->belongsToMany('App\Reservering','reservering_tafel');
    }
}
