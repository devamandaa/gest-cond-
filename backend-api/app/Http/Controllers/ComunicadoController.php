<?php

namespace App\Http\Controllers;

use App\Models\Comunicado;
use Illuminate\Http\Request;

class ComunicadoController extends Controller
{
    /**
     * Lista todos os comunicados
     */
    public function index()
    {
        return response()->json(Comunicado::all(), 200);
    }

    /**
     * Cria um novo comunicado
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'data_publicacao' => 'required|date',
            'categoria' => 'nullable|string|max:255',
            'icone' => 'nullable|string|max:255',
            'publicado' => 'boolean',
            'autor_id' => 'required|exists:user,id',
        ]);

        $comunicado = Comunicado::create($validated);

        return response()->json($comunicado, 201);
    }

    /**
     * Mostra um comunicado específico
     */
    public function show($id)
    {
        $comunicado = Comunicado::findOrFail($id);
        return response()->json($comunicado);
    }

    /**
     * Atualiza um comunicado
     */
    public function update(Request $request, $id)
    {
        $comunicado = Comunicado::findOrFail($id);

        $validated = $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'conteudo' => 'sometimes|required|string',
            'data_publicacao' => 'sometimes|required|date',
            'categoria' => 'nullable|string|max:255',
            'icone' => 'nullable|string|max:255',
            'publicado' => 'boolean',
            'autor_id' => 'sometimes|required|exists:user,id',
        ]);

        $comunicado->update($validated);

        return response()->json($comunicado);
    }

    /**
     * Deleta um comunicado
     */
    public function destroy($id)
    {
        $comunicado = Comunicado::findOrFail($id);
        $comunicado->delete();

        return response()->json(['mensagem' => 'Comunicado deletado com sucesso.']);
    }
}
