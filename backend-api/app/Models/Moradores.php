<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Morador extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'apartamento',
        'bloco',
        'unidade',
        'status',
        'observacoes'
    ];

    protected $casts = [
        'email' => 'string',
        'telefone' => 'string',
        'status' => 'string',
    ];
}
