<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function chamados()
    {
        return $this->belongsToMany(Chamado::class);
    }

    public function papeis()
    {
        return $this->belongsToMany(Papel::class);
    }

    public function isSuperAdmin()
    {
        return $this->existePapel('Admin');
    }

    public function addPapel($papel)
    {
        if(is_string($papel)){
            $papel = Papel::where('nome', '=' , $papel)->firstOrFail();
        }

        if($this->existePapel($papel)){
            return;
        }

        return $this->papeis()->attach($papel);
    }

    public function existePapel($papel)
    {
        if (is_string($papel)) {
            $papel = Papel::where('nome', '=', $papel)->firstOrFail();
        }

        return (boolean) $this->papeis()->find($papel->id);
    }

    public function destroyPapel($papel)
    {
        if(is_string($papel)){
            $papel = Papel::where('nome', '=' , $papel)->firstOrFail();
        }

        return $this->papeis()->detach($papel);
    }

    public function temUmPapelDestes($papeis)
    {
         $userPapeis = $this->papeis;
         return $papeis->intersect($userPapeis);
    }
}
