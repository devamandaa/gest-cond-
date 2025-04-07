<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = [
        'area_comum',
        'data',
        'hora_inicio',
        'hora_fim',
        'morador',
        'status'
    ];
}
