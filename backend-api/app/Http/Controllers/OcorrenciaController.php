<?php

namespace App\Http\Controllers;

use App\Models\Ocorrencia;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OcorrenciaController extends Controller
{
    // 🔹 Listar todas as ocorrências
    public function index()
    {
        return response()->json(Ocorrencia::all());
    }

    // 🔹 Criar nova ocorrência
    public function store(Request $request)
    {
        $ocorrencia = Ocorrencia::create($request->all());
        return response()->json($ocorrencia, 201);
    }

    // 🔹 Ver uma ocorrência específica
    public function show($id)
    {
        $ocorrencia = Ocorrencia::findOrFail($id);
        return response()->json($ocorrencia);
    }

    // 🔹 Atualizar ocorrência
    public function update(Request $request, $id)
    {
        $ocorrencia = Ocorrencia::findOrFail($id);
        $ocorrencia->update($request->all());
        return response()->json($ocorrencia);
    }

    // 🔹 Deletar ocorrência
    public function destroy($id)
    {
        $ocorrencia = Ocorrencia::findOrFail($id);
        $ocorrencia->delete();
        return response()->json(null, 204);
    }

    // ✅ Adicionar resposta do administrador
    public function responder(Request $request, $id)
    {
        $request->validate([
            'resposta_admin' => 'required|string'
        ]);

        $ocorrencia = Ocorrencia::findOrFail($id);
        $ocorrencia->resposta_admin = $request->resposta_admin;
        $ocorrencia->status = 'em andamento';
        $ocorrencia->save();

        return response()->json(['mensagem' => 'Resposta adicionada com sucesso.']);
    }

    // ✅ Resolver ocorrência (muda status e data_resolucao)
    public function resolver($id)
    {
        $ocorrencia = Ocorrencia::findOrFail($id);
        $ocorrencia->status = 'resolvida';
        $ocorrencia->data_resolucao = Carbon::now();
        $ocorrencia->save();

        return response()->json(['mensagem' => 'Ocorrência marcada como resolvida.']);
    }

    // ✅ Buscar ocorrências por morador
    public function porMorador($nome)
    {
        $ocorrencias = Ocorrencia::where('morador', 'like', "%{$nome}%")->get();
        return response()->json($ocorrencias);
    }

    // ✅ Buscar por unidade
    public function porUnidade($unidade)
    {
        $ocorrencias = Ocorrencia::where('unidade', $unidade)->get();
        return response()->json($ocorrencias);
    }

    // ✅ Buscar por status (aberta, em andamento, resolvida)
    public function porStatus($status)
    {
        $ocorrencias = Ocorrencia::where('status', $status)->get();
        return response()->json($ocorrencias);
    }

    // ✅ Estatísticas: totais por status e tipo
    public function estatisticas()
    {
        return response()->json([
            'total' => Ocorrencia::count(),
            'por_status' => Ocorrencia::selectRaw('status, COUNT(*) as total')->groupBy('status')->get(),
            'por_tipo' => Ocorrencia::selectRaw('tipo, COUNT(*) as total')->groupBy('tipo')->get(),
        ]);
    }
}
