<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encomendas extends Model 
{
    use HasFactory;

    protected $table = 'encomendas';

    protected $fillable =[

        'nome_morador',
        'bloco',
        'apartamento',
        'descricao', 
        'data_chegada',
        'foto',
        'transportadora',
        'status', 
        'data_retirada',
        'retirado_por',
    ];

    protected $dates =[

        'data_chegada',
        'data_retirada', 
        'created_at', 
        'updated_at',

    ]; 
}