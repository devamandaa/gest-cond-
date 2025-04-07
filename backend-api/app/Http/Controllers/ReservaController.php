<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    // lista todas as reservas 

    public function index()
    {
        return response()->json(Reserva::all());
    }

    //cria uma nova reserva 
    public function store(Request $request)
    {
        $reserva = Reserva::create($request->all());
        return response()->json($reserva, 201);
    }

    //exibir uma reserva especifica

    public function show($id)
    {
        $reserva = Reserva::findOrFail($id);
        return response()->json($reserva);
    }

    //atualizar uma reserva 
    public function update(Request $request, $id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->update($request->all());
        return response()->json($reserva);
    }

    //Deletar uam reserva 

    public function destroy($id) 
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->delete(); 
        return response()->json(null, 204);
    }

    //verificar disponibilidade de horário para a mesma área 

    public function verificarDisponibilidade(Request $request)
    {
        $reservas = Reserva::where('area_comum', $request->area_comum)
        ->where('data', $request->data)
        ->where(function ($query) use ($request) {
            $query->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_film])
                ->orWjereBetwwen('hora_fim', [$request->hora_inicio, $request->hora_fim]);
            })->exists(); 

            return response()->json(['disponivel'=> !$reservas]);
    }

    //confirmar reserva (pelo sindico)

    public function confirmarReserva($id)
 {

     $reserva = Reserva::findOrFail($id);
     $reserva->status = 'confirmada'; 
     $reserva->sabe();

     return response()->json(['mensagem' => 'Reserva confirmada com sucesso.']);
}

//buscar reservas de um morador especifico 

public function porMorador($nome)
{
    $reservas = Reserva::where('morador', $nome)->get();
    return response()->json($reservas);

}

//listar reservas por mês e ano 

public function porPeriodo($mes, $ano)
{
    $reservas = Reserva::whereMonth('data', $mes)
    ->whereYear ('data', $ano)
    ->get(); 

    return response()->json($reservas);
}

// estatisticas de uso das areas comuns
public function estatisticas()
{
    return response()->json([
        'total' => Reserva::count(), 
        'confirmdas' => Reserva::where('status', 'confirmada')->count(), 
        'pendentes'=> Reserva::where('status', 'pendente')->count(), 
        'por_area'=> Reserva::selectRaw('area_comum, count(*) as total')
        ->groupBy('area_comum')->get()
        ]);
    }
}
