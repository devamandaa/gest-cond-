<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    /**
     * Campos que podem ser preenchidos em massa (mass assignment).
     */
    protected $fillable = [
        'dia',
        'titulo',
        'descricao',
        'horario',
    ];
}
