<?php

namespace App\Http\Controllers;

use App\Models\Financeiro;

class FinanceiroController extends Controller
{
    // Retorna todos os registros
    public function index()
    {
        return response()->json(Financeiro::all());
    }

    // Cria um novo lançamento financeiro
    public function store()
    {
        request()->validate([
            'tipo' => 'required|in:receita,despesa',
            'categoria' => 'required|string|max:100',
            'valor' => 'required|numeric|min:0',
            'data' => 'required|date',
            'descricao' => 'nullable|string',
            'status' => 'in:pendente,pago'
        ]);

        $financeiro = Financeiro::create(request()->all());
        return response()->json($financeiro, 201);
    }

    // Exibe um lançamento específico
    public function show($id) 
    {
        $financeiro = Financeiro::findOrFail($id);
        return response()->json($financeiro);
    }

    // Atualiza um lançamento completo
    public function update($id)
    {
        $financeiro = Financeiro::findOrFail($id);

        request()->validate([
            'tipo' => 'in:receita,despesa',
            'categoria' => 'string|max:100',
            'valor' => 'numeric|min:0',
            'data' => 'date',
            'descricao' => 'nullable|string',
            'status' => 'in:pendente,pago'
        ]);

        $financeiro->update(request()->all());
        return response()->json($financeiro);
    }

    // Atualiza só o status (marcar como pago, por exemplo)
    public function atualizarStatus($id)
    {
        $financeiro = Financeiro::findOrFail($id);

        request()->validate([
            'status' => 'required|in:pendente,pago'
        ]);

        $financeiro->status = request('status');
        $financeiro->save();

        return response()->json(['message' => 'Status atualizado com sucesso!', 'data' => $financeiro]);
    }

    // Deleta um lançamento
    public function destroy($id)
    {
        $financeiro = Financeiro::findOrFail($id);
        $financeiro->delete();

        return response()->json(null, 204);
    }

    // Filtro por mês e ano
    public function mensal()
    {
        $mes = request('mes');
        $ano = request('ano');

        $dados = Financeiro::whereMonth('data', $mes)
            ->whereYear('data', $ano)
            ->get();

        return response()->json($dados);
    }

    // Retorna o resumo financeiro do mês
    public function resumo()
    {
        $mes = request('mes');
        $ano = request('ano');

        $receitas = Financeiro::where('tipo', 'receita')
            ->whereMonth('data', $mes)
            ->whereYear('data', $ano)
            ->sum('valor');

        $despesas = Financeiro::where('tipo', 'despesa')
            ->whereMonth('data', $mes)
            ->whereYear('data', $ano)
            ->sum('valor');

        return response()->json([
            'receita' => $receitas,
            'despesa' => $despesas,
            'saldo' => $receitas - $despesas
        ]);
    }

    // Lista todas as despesas pendentes
    public function pendentes()
    {
        return response()->json(Financeiro::where('status', 'pendente')->get());
    }

    // Lista todas as despesas pagas
    public function pagas()
    {
        return response()->json(Financeiro::where('status', 'pago')->get());
    }
}
