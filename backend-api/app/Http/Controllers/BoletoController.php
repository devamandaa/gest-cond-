<?php

namespace App\Http\Controllers;

use App\Models\Boleto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use PDF; 

 Class BoletoController extends Controller 
 {
    //Listar todos os boletos

    public function index()
    {
        return response()->json(Boleto::all());
    }

    //Criar novo boleto
    public function store(Request $request)
    {
        $boleto = Boleto::create($request->all());
        return response()->json($boleto, 201);
    }

    //exibir um boleto especifico
    
    public function show($id)
    {
        $boleto = Boleto::findOrFail($id);
        return response()->json($boleto);
    }

    //Atualizar um boleto existente
    public function update(Request $request, $id)
    {
        $boleto = Boleto::findOrFail($id);
        $boleto->update($request->all());
        return response()->json($boleto);
    }

    //Deletar um boleto
    public function destroy($id)
    {
        $boleto = Boleto::findOrFail($id);
        $boleto->delete(); 
        return response()->json(null, 204);

    }

    //Gerar PDF do boleto
    public function gerarpdf($id)
    {
        $boleto = Boleto::findOrFail($id);
        $pdf = PDF::loadView('pdf.boleto' , compact('boleto'));
        return $pdf->download("boleto_{boleto->id}.pdf");
    } 

    //Upload de comprovante de pagamento 

    public function enviarComprovante(Request $request, $id)
    {
        $request->validate([
            'comprovante' => 'required|file|mimes:pdf,jpg,png|max::2025',
        ]);

        $boleto = Boleto::findOrFail($id);
        $path = $request->file('comprovante')->store('Comprovantes');
        $boleto->comprovante = $path; 
        $boleto->save(); 

        return response()->json(['message' => 'Comprovante enviado com sucesso!', 'path' => $path]);
    }

    //simular multa e jusros de boleto vencidos

    public function simularMultasJuros($id)
    {
        $boleto = boleto::findOrFail($id);
        $vencimento = Carbon::parse($boleto->data_vencimento);
        $hoje = now();

        if ($hoje->lte($vencimento)) {
            return response()->json(['multa' =>0, 'juros' =>0, 'total' =>$boleto->valor]);
        }

        $diasAtraso = $hoje->diffInDays($vencimento);
        $multa=$boleto->valor *0.02; //2%
        $juros = $boleto->valor *0.001 * $diasAtraso; //0.1% por dia

        return response()->json([
            'dias_atraso' => diasAtraso,
            'multa' => number_format($multa, 2),
            'juros' => number_format($juros, 2),
            'total' => number_format($boleto->valor + $multa + $juros, 2)
        ]);
    }

    // Renegociar boleto vencido

    public function renegociar($id)
    {
        $boleto = Boleto::findOrFail($id);

        if ($boleto->status !== 'vencido') {
            return response()->json(['erro' => 'Apenas boletos vencidos podem ser renegociados.'], 400);
        }

        $boleto->status = 'renegociado';
        $boleto->data_vencimento = now()->addDays(7);
        $boleto->save();

        return response()->json(['mensagem' => 'Boleto renegociado com novo vencimento.']);
    }

    //Estatísticas dos pagamentos
    public function estatisticasPagamentos()
    {
        return response()->json([
            'pagos' => boletos::where('status', 'pago')->count(),
            'pendentes' => Boleto::where('status', 'pendente')->count(), 
            'vencidos' => boleto::where('status', 'vencido')->count(),
            'renegociados' =>Boleto::where('status', 'renegociado')->count(), 
        ]);
    }

    //Historico de pagamentos por ano 
    
    public function historico($ano)
    {
        return response()->json(
            Boleto::whereYear('data_pagamento', $ano)->get()

        );
    }


 }


