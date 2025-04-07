<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrdemServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrdemServicoController extends Controller
{
    public function index()
    {
        return OrdemServico::all();
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'prioridade' => 'required|in:baixa,media,alta',
            'responsavel' => 'nullable|string|max:255',
            'status' => 'required|in:pendente,em_andamento,concluida,cancelada',
            'data' => 'nullable|date',
            'anexo' => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('anexo')) {
            $dados['anexo'] = $request->file('anexo')->store('ordens', 'public');
        }

        $ordem = OrdemServico::create($dados);
        return response()->json($ordem, 201);
    }

    public function update(Request $request, $id)
    {
        $ordem = OrdemServico::findOrFail($id);

        $dados = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'prioridade' => 'required|in:baixa,media,alta',
            'responsavel' => 'nullable|string|max:255',
            'status' => 'required|in:pendente,em_andamento,concluida,cancelada',
            'data' => 'nullable|date',
            'anexo' => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('anexo')) {
            // Exclui o arquivo anterior, se houver
            if ($ordem->anexo) {
                Storage::disk('public')->delete($ordem->anexo);
            }

            $dados['anexo'] = $request->file('anexo')->store('ordens', 'public');
        }

        $ordem->update($dados);
        return response()->json($ordem);
    }

    public function destroy($id)
    {
        $ordem = OrdemServico::findOrFail($id);
        
        if ($ordem->anexo) {
            Storage::disk('public')->delete($ordem->anexo);
        }

        $ordem->delete();
        return response()->json(null, 204);
    }
}
