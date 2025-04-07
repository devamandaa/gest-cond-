<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Historico;

class HistoricoController extends Controller {
    public function index()
    {
        return historico::orderBy('data', 'desc')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'descricao' => 'required|string|max:255',
            'data' => 'required|date',
        ]);

        return historico::create($validated);
    }

    public function show($id)
    {
        return Historico::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $historico = Historico::findOrFail($id);
        $historico->update($request->all());
        return $historico;
    }

    public function destroy($id)
    {
        return Historico::destroy($id);
    }
}