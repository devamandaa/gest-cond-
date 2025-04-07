<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function index()
    {
        return Funcionario::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'status' => 'required|string',
            'foto' => 'nullable|string',
        ]);

        $funcionario = Funcionario::create($validated);
        return response()->json($funcionario, 201);
    }

    public function show($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        return response()->json($funcionario);
    }

    public function update(Request $request, $id)
    {
        $funcionario = Funcionario::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'status' => 'required|string',
            'foto' => 'nullable|string',
        ]);

        $funcionario->update($validated);
        return response()->json($funcionario);
    }

    public function destroy($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $funcionario->delete();

        return response()->json(['message' => 'Funcionário excluído com sucesso']);
    }
}
