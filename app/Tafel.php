<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Menu;

class Tafel extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'naam', 'stoelen',
    ];

    public function rules()
    {
        return [
            'naam' => 'required',
            'stoelen' => 'required','integer',
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
        return $this->belongsToMany('App\Menu','reservering_tafel');
    }
}
