<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model 
{
    protected $table = 'ordens_servico';

    protected $fillable = [
        'titulo',
        'descricao',
        'prioridade',
        'responsavel',
        'status',
        'data',
        'anexo',

    ];
}