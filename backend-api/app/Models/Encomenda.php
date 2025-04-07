<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_rastreio',
        'descricao',
        'recebido_em',
        'morador_id',
        'entregue',
    ];

    protected $casts = [
        'recebido_em' => 'datetime',
        'entregue' => 'boolean',
    ];

    // Relacionamento com morador
    public function morador()
    {
        return $this->belongsTo(Morador::class);
    }
}
