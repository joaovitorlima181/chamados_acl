<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Papel extends Model
{
    use HasFactory;

    protected $table = 'papeis';
    protected $fillable = ['nome', 'descricao'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissoes()
    {
        return $this->belongsToMany(Permissao::class);
    }

    public function addPermissao($permissao)
    {
        if(is_string($permissao)){
            $permissao = Permissao::where('nome', '=' , $permissao)->firstOrFail();
        }

        if($this->existePermissao($permissao)){
            return;
        }

        return $this->permissoes()->attach($permissao);
    }

    public function existePermissao($permissao)
    {
        if (is_string($permissao)) {
            $permissao = Permissao::where('nome', '=', $permissao)->firstOrFail();
        }

        return (boolean) $this->permissoes()->find($permissao->id);
    }

    public function destroyPermissao($permissao)
    {
        if(is_string($permissao)){
            $permissao = Permissao::where('nome', '=' , $permissao)->firstOrFail();
        }

        return $this->permissoes()->detach($permissao);
    }
}
