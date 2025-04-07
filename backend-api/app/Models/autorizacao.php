<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autorizacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_visitante',
        'documento',
        'tipo_autorizacao',
        'data_hora_entrada',
        'morador_id',
    ];

    // Relacionamento com morador
    public function morador()
    {
        return $this->belongsTo(Morador::class);
    }
}
