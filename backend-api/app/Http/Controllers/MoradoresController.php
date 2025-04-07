<?php

namespace App\Http\Controllers;

use App\Models\Morador;
use Illuminate\Http\Request;

class MoradoresController extends Controller 
{
    public function index()
    {
        return response()->json(Morador::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telefone' => 'nullable|string|max:20',
            'apartamento' => 'required|string|max:20',
            'bloco' => 'nullable|string|max:20',
            'status' => 'in:ativo,inativo',
            'observacoes' => 'nullable|string'
        ]);

        $dados = $request->all();
        $dados['unidade'] = 'Bloco ' . $request->bloco . ' - ' . $request->apartamento;

        $morador = Morador::create($dados);
        return response()->json(['mensagem' => 'Morador cadastrado com sucesso!', 'morador' => $morador], 201);
    }

    public function show($id)
    {
        $morador = Morador::findOrFail($id);
        return response()->json($morador);
    }

    public function update(Request $request, $id)
    {
        $morador = Morador::findOrFail($id);

        $request->validate([
            'nome' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'telefone' => 'nullable|string|max:20',
            'apartamento' => 'nullable|string|max:20',
            'bloco' => 'nullable|string|max:20',
            'status' => 'in:ativo,inativo',
            'observacoes' => 'nullable|string'
        ]);

        $dados = $request->all();

        if ($request->has('bloco') && $request->has('apartamento')) {
            $dados['unidade'] = 'Bloco ' . $request->bloco . ' - ' . $request->apartamento;
        }

        $morador->update($dados);
        return response()->json(['mensagem' => 'Morador atualizado!', 'morador' => $morador]);
    }

    public function destroy($id)
    {
        $morador = Morador::findOrFail($id);
        $morador->delete();

        return response()->json(['mensagem' => 'Morador removido com sucesso.'], 204);
    }

    public function atualizarStatus(Request $request, $id)
    {
        $morador = Morador::findOrFail($id);

        $request->validate([
            'status' => 'required|in:ativo,inativo'
        ]);

        $morador->status = $request->status;
        $morador->save();

        return response()->json(['mensagem' => 'Status atualizado!', 'morador' => $morador]);
    }

    public function ativos()
    {
        return response()->json(Morador::where('status', 'ativo')->get());
    }

    public function inativos()
    {
        return response()->json(Morador::where('status', 'inativo')->get());
    }
}
