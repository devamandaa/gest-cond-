<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Encomenda;

class EncomendaController extends Controller
{
    // 🟢 Cadastrar uma nova encomenda
    public function store(Request $request)
    {
        $request->validate([
            'nomeMorador' => 'required|string|max:255',
            'bloco' => 'nullable|string|max:50',
            'apartamento' => 'nullable|string|max:50',
            'descricao' => 'nullable|string',
            'dataChegada' => 'nullable|date',
            'transportadora' => 'nullable|string|max:100',
            'foto' => 'nullable|image|max:2048',
        ]);

        $encomenda = new Encomenda();
        $encomenda->nome_morador = $request->nomeMorador;
        $encomenda->bloco = $request->bloco;
        $encomenda->apartamento = $request->apartamento;
        $encomenda->descricao = $request->descricao;
        $encomenda->data_chegada = $request->dataChegada;
        $encomenda->transportadora = $request->transportadora;

        if ($request->hasFile('foto')) {
            $encomenda->foto = $request->file('foto')->store('encomendas', 'public');
        }

        $encomenda->status = 'aguardando-retirada';
        $encomenda->save();

        return response()->json([
            'message' => 'Encomenda cadastrada com sucesso.',
            'data' => $encomenda
        ], 201);
    }

    // ✅ Confirmar retirada
    public function confirmarRetirada(Request $request, $id)
    {
        $request->validate([
            'dataRetirada' => 'required|date',
            'retiradoPor' => 'required|string|max:255',
        ]);

        $encomenda = Encomenda::findOrFail($id);
        $encomenda->status = 'retirada';
        $encomenda->data_retirada = $request->dataRetirada;
        $encomenda->retirado_por = $request->retiradoPor;
        $encomenda->save();

        return response()->json([
            'message' => 'Retirada confirmada.',
            'data' => $encomenda
        ]);
    }

    // 📜 Listar histórico
    public function index()
    {
        return response()->json(Encomenda::orderBy('created_at', 'desc')->get());
    }

    // 📊 Relatório simples
    public function relatorio()
    {
        $total = Encomenda::count();

        $maisRecebem = Encomenda::select('nome_morador')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('nome_morador')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $tempoMedio = Encomenda::whereNotNull('data_retirada')
            ->selectRaw('AVG(TIMESTAMPDIFF(HOUR, data_chegada, data_retirada)) as tempo_medio')
            ->value('tempo_medio');

        return response()->json([
            'total_encomendas' => $total,
            'top_moradores' => $maisRecebem,
            'tempo_medio_retirada' => round($tempoMedio ?? 0, 2),
        ]);
    }
}
