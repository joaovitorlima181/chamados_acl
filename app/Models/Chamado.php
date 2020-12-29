<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'titulo', 'descricao', 'status'];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
