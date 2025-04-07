<?php

namespace App\Http\Controllers;

use App\Models\Autorizacao;
use Illuminate\Http\Request;

class AutorizacaoController extends Controller
{
    public function index()
    {
        return Autorizacao::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome_visitante' => 'required|string',
            'documento' => 'nullable|string',
            'tipo_autorizacao' => 'nullable|string',
            'data_hora_entrada' => 'nullable|date',
            'morador_id' => 'required|exists:moradores,id',
        ]);

        return Autorizacao::create($data);
    }

    public function show($id)
    {
        return Autorizacao::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $autorizacao = Autorizacao::findOrFail($id);

        $autorizacao->update($request->all());

        return $autorizacao;
    }

    public function destroy($id)
    {
        $autorizacao = Autorizacao::findOrFail($id);
        $autorizacao->delete();

        return response()->json(['message' => 'Autorização deletada com sucesso.']);
    }
}
