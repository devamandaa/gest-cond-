<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comunicado extends Model
{
    use HasFactory;

    protected $fillable =[
        'titulo',
        'conteudo',
        'data_publicacao',
        'categoria',
        'icone',
        'publicado',
        'autor_id'
    ];

    
} 