
<?php

namespace App\Http\Controllers;

use App\Models\Boleto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use PDF;

class BoletoController extends Controller
{
    public function index()
    {
        return response()->json(Boleto::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mes_ano' => 'required|string',
            'valor' => 'required|numeric|min:0',
            'data_vencimento' => 'required|date',
            'status' => 'in:pendente,pago,vencido,renegociado',
            'data_pagamento' => 'nullable|date',
            'comprovante' => 'nullable|string',
            'morador_id' => 'nullable|integer|exists:moradores,id',
            'descricao' => 'nullable|string'
        ]);

        $boleto = Boleto::create($validated);
        return response()->json($boleto, 201);
    }

    public function show($id)
    {
        $boleto = Boleto::findOrFail($id);
        return response()->json($boleto);
    }

    public function update(Request $request, $id)
    {
        $boleto = Boleto::findOrFail($id);

        $validated = $request->validate([
            'mes_ano' => 'sometimes|string',
            'valor' => 'sometimes|numeric|min:0',
            'data_vencimento' => 'sometimes|date',
            'status' => 'in:pendente,pago,vencido,renegociado',
            'data_pagamento' => 'nullable|date',
            'comprovante' => 'nullable|string',
            'morador_id' => 'nullable|integer|exists:moradores,id',
            'descricao' => 'nullable|string'
        ]);

        $boleto->update($validated);
        return response()->json($boleto);
    }

    public function destroy($id)
    {
        $boleto = Boleto::findOrFail($id);
        $boleto->delete();
        return response()->json(null, 204);
    }

    public function gerarPdf($id)
    {
        $boleto = Boleto::findOrFail($id);
        $pdf = PDF::loadView('pdf.boleto', compact('boleto'));
        return $pdf->download("boleto_{$boleto->id}.pdf");
    }

    public function enviarComprovante(Request $request, $id)
    {
        $request->validate([
            'comprovante' => 'required|file|mimes:pdf,jpg,png|max:2025',
        ]);

        $boleto = Boleto::findOrFail($id);
        $path = $request->file('comprovante')->store('comprovantes');
        $boleto->comprovante = $path;
        $boleto->save();

        return response()->json(['message' => 'Comprovante enviado com sucesso!', 'path' => $path]);
    }

    public function simularMultaJuros($id)
    {
        $boleto = Boleto::findOrFail($id);
        $vencimento = Carbon::parse($boleto->data_vencimento);
        $hoje = now();

        if ($hoje->lte($vencimento)) {
            return response()->json(['multa' => 0, 'juros' => 0, 'total' => $boleto->valor]);
        }

        $diasAtraso = $hoje->diffInDays($vencimento);
        $multa = $boleto->valor * 0.02;
        $juros = $boleto->valor * 0.001 * $diasAtraso;

        return response()->json([
            'dias_atraso' => $diasAtraso,
            'multa' => number_format($multa, 2),
            'juros' => number_format($juros, 2),
            'total' => number_format($boleto->valor + $multa + $juros, 2)
        ]);
    }

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

    public function estatisticasPagamentos()
    {
        return response()->json([
            'pagos' => Boleto::where('status', 'pago')->count(),
            'pendentes' => Boleto::where('status', 'pendente')->count(),
            'vencidos' => Boleto::where('status', 'vencido')->count(),
            'renegociados' => Boleto::where('status', 'renegociado')->count(),
        ]);
    }

    public function historico($ano)
    {
        return response()->json(
            Boleto::whereYear('data_pagamento', $ano)->get()
        );
    }
}
