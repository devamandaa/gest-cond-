<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ocorrencia;
use Barryvdh\DomPDF\Facade\Pdf;

class RelatorioController extends Controller
{
    /**
     * Gera relatório de ocorrências, com opção de exportar em PDF.
     */
    public function ocorrencias(Request $request)
    {
        // Inicializa a query
        $query = Ocorrencia::query();

        // Filtro por status
        if (!empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Filtro por intervalo de datas
        if (!empty($request->data_inicio) && !empty($request->data_fim)) {
            $query->whereBetween('created_at', [
                date('Y-m-d 00:00:00', strtotime($request->data_inicio)),
                date('Y-m-d 23:59:59', strtotime($request->data_fim))
            ]);
        }

        // Busca resultados ordenados
        $ocorrencias = $query->orderBy('created_at', 'desc')->get();

        // Exportar como PDF
        if ($request->boolean('exportar_pdf')) {
            $pdf = Pdf::loadView('pdf.ocorrencias', ['ocorrencias' => $ocorrencias]);
            return $pdf->download('relatorio-ocorrencias.pdf');
        }
        
        // Retorno padrão em JSON
        return response()->json($ocorrencias);
    }
}
