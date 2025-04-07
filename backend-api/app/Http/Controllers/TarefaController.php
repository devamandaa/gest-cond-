<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tarefa;

class TarefaController extends Controller
{
    public function index()
    {
        return Tarefa::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'prioridade' => 'in:Baixa,Média,Alta',
            'concluida' => 'boolean'
        ]);

        return Tarefa::create($validated);
    }

    public function show($id)
    {
        return Tarefa::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $tarefa = Tarefa::findOrFail($id);
        $tarefa->update($request->all());
        return $tarefa;
    }

    public function destroy($id)
    {
        return Tarefa::destroy($id);
    }
}
