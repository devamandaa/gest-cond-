<?php

namespace App\Http\Controllers\Api;

use App\Http\controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evento;

class EventoController extends controller 
{
    public function index ()
    {
        return Evento::all();

    }

    public function store (Request $request)
    {
        $validate = $request->validate([
            'dia' => 'required|integer|min:1|max:31',
            'titulo' => 'required|string|max:255',
            'descricao'=> 'nullable|string',
            'horario' => 'required|date_format:h:i', 
        ]);

        $evento = Evento::create($validate);
        return response()->json($evento, 201);
    }

    public function show($id)
    {
        return Evento::findOrFail($id);
    }

    public function porDia($dia)
    {
        return Evento::where('dia', $dia)->get();
    }

    public function update(request $request, $id)
    {
        $evento = Evento::findOrFail($id);
        $evento->update($request->all());
    }

    public function destroy($id)
    {
        Evento::destroy($id);
        return response()->json(['message' => 'Evento deletado']);
    }
}

