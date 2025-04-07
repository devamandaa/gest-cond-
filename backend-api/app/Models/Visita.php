<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_visitante',
        'documento',
        'foto',
        'unidade_id',
        'morador_id',
        'data_entrada',
        'data_saida',
        'observacoes'
    ];

    // Se quiser usar relacionamento com Unidade e Morador:
   
    public function morador()
    {
        return $this->belongsTo(Morador::class);
    }
}
