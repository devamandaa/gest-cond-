<?php

namespace App\Http\Controllers;

use App\Models\Prestador;
use Illuminate\Http\Request;

class PrestadorController extends Controller
{
    public function index()
    {
        return Prestador::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string',
            'documento' => 'nullable|string',
            'telefone' => 'nullable|string',
            'empresa' => 'nullable|string',
        ]);

        return Prestador::create($data);
    }

    public function show($id)
    {
        return Prestador::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $prestador = Prestador::findOrFail($id);

        $prestador->update($request->all());

        return $prestador;
    }

    public function destroy($id)
    {
        $prestador = Prestador::findOrFail($id);
        $prestador->delete();

        return response()->json(['message' => 'Prestador deletado com sucesso.']);
    }
}
