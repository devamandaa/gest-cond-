<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boleto extends Model
{
    use HasFactory;

    protected $fillable = [
        'mes_ano',          // Ex: Março/2025

        'valor',            // Valor do boleto

        'data_vencimento',  // Data de vencimento

        'status',           // Status: pendente, pago, vencido, renegociado

        'data_pagamento',   // Data em que foi pago

        'comprovante',      // Caminho do comprovante enviado

        'morador_id',       // (FK) ID do morador
        
        'descricao'         // Texto explicativo ou observação
    ];
}
