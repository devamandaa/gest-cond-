<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsApp extends Model
{
    use HasFActory;

    protected $fillable =[
        'morador_id',
        'telefone', 
        'mensagem',
    ];

    //Relacionamento com o morador (opcional)

    public function morador()
    {
        return $this->belongsTo(Morador::class);
    }
}