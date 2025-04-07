<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Http\Request;

class VisitaController extends Controller
{
    /**
     * Listar todas as visitas
     */
    public function index()
    {
        return response()->json(Visita::all());
    }

    /**
     * Criar uma nova visita
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome_visitante' => 'required|string',
            'documento' => 'required|string',
            'foto' => 'nullable|string',
            'unidade_id' => 'required|integer',
            'morador_id' => 'required|integer',
            'data_entrada' => 'nullable|date',
            'data_saida' => 'nullable|date',
            'observacoes' => 'nullable|string',
        ]);

        $visita = Visita::create($data);

        return response()->json($visita, 201);
    }

    /**
     * Exibir uma visita específica
     */
    public function show($id)
    {
        $visita = Visita::findOrFail($id);
        return response()->json($visita);
    }

    /**
     * Atualizar uma visita
     */
    public function update(Request $request, $id)
    {
        $visita = Visita::findOrFail($id);

        $data = $request->validate([
            'nome_visitante' => 'sometimes|required|string',
            'documento' => 'sometimes|required|string',
            'foto' => 'nullable|string',
            'unidade_id' => 'sometimes|required|integer',
            'morador_id' => 'sometimes|required|integer',
            'data_entrada' => 'nullable|date',
            'data_saida' => 'nullable|date',
            'observacoes' => 'nullable|string',
        ]);

        $visita->update($data);

        return response()->json($visita);
    }

    /**
     * Deletar uma visita
     */
    public function destroy($id)
    {
        $visita = Visita::findOrFail($id);
        $visita->delete();

        return response()->json(['mensagem' => 'Visita excluída com sucesso']);
    }
}
