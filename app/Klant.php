<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Reservering;

class Klant extends Model
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'voornaam', 'achternaam','email', 'telefoonnummer'
    ];

    public function rules($methodtype, $klant = false)
    {

        switch($methodtype)
        {
            case'POST':
                {
                    return [
                        'naam' => 'string',
                        'email' => 'string|unique:klants,email',
                        'telefoonnummer' => 'numeric|regex:/(06)[0-9]{8}/',
                    ];
                }
            case'PUT':
                {
                    return [
                        'naam' => 'string',
                        'email' => 'string|unique:klants,id,' . $klant->id,
                        'telefoonnummer' => 'numeric|regex:/(06)[0-9]{8}/',
                    ];
                }
                default:break;
        }
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function reservering(){
        $this->hasMany('App\Reservering','id');
    }
}
