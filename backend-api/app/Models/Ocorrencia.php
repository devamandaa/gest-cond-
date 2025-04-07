<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ocorrencia extends Model
{
    protected $fillable = [
        'titulo',
        'descrição',
        'morador',
        'status', 
        'tipo', 
        'unidade',
        'prioridade',
        'data_resolucao',
        'resposta_admin',
        'anexo'
    ];
}