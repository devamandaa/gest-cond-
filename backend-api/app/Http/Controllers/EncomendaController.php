<?php

namespace App\Http\Controllers;

use App\Models\Encomenda;
use Illuminate\Http\Request;

class EncomendaController extends Controller
{
    public function index()
    {
        return Encomenda::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'codigo_rastreio' => 'nullable|string',
            'descricao' => 'nullable|string',
            'recebido_em' => 'nullable|date',
            'morador_id' => 'required|exists:moradores,id',
            'entregue' => 'boolean'
        ]);

        return Encomenda::create($data);
    }

    public function show($id)
    {
        return Encomenda::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $encomenda = Encomenda::findOrFail($id);

        $encomenda->update($request->all());

        return $encomenda;
    }

    public function destroy($id)
    {
        $encomenda = Encomenda::findOrFail($id);
        $encomenda->delete();

        return response()->json(['message' => 'Encomenda deletada com sucesso.']);
    }
}
