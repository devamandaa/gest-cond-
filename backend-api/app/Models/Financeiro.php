<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class financeiro extends Model
{
    protected $fillable =[
        'tipo',
        'categoria',
        'valor',
        'data', 
        'descricao',
        'status'
    ];

    //Casts para facilitar manipulação de datas e valores 
    protected $casts = [
        'data' => 'date',
        'valor' => 'decimal:2'
    ];
}