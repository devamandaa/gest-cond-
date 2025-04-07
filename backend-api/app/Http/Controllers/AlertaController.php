<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alerta;

class AlertaController extends Controller
{
    public function index()
    {
        return Alerta::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mensagem' => 'required|string|max:255',
            'tipo' => 'in:urgente,comunicado,aviso',
            'data' => 'nullable|date',
        ]);

        return Alerta::create($validated);
    }

    public function show($id)
    {
        return Alerta::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $alerta = Alerta::findOrFail($id);
        $alerta->update($request->all());
        return $alerta;
    }

    public function destroy($id)
    {
        return Alerta::destroy($id);
    }
}
