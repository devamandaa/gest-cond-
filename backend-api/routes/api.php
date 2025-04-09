<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers de autenticação e recursos principais
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoletoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ComunicadoController;
use App\Http\Controllers\OcorrenciaController; 
use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\MoradoresController;
use App\Http\Controllers\Api\EventoController;
use App\Http\Controllers\Api\TarefaController;
use App\Http\Controllers\Api\AlertaController;
use App\Http\Controllers\Api\HistoricoController;
use App\Http\Controllers\Api\OrdemServicoController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\WhatsAppController;
use App\Http\Controllers\FuncionarioController;


// ✅ NOVOS CONTROLLERS INCLUÍDOS
use App\Http\Controllers\PrestadorController;
use App\Http\Controllers\AutorizacaoController;
use App\Http\Controllers\EncomendaController;

// ----------------------------------------
// ROTAS DE AUTENTICAÇÃO
// ----------------------------------------

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ----------------------------------------
// ROTAS DE EVENTOS (Agenda do Síndico)
// ----------------------------------------

Route::prefix('eventos')->controller(EventoController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
    Route::get('/dia/{dia}', 'porDia');
});

// ----------------------------------------
// ROTAS DE TAREFAS (Agenda do Síndico)
// ----------------------------------------

Route::apiResource('tarefas', TarefaController::class);

// ----------------------------------------
// ROTAS DE ALERTAS (Painel do Síndico)
// ----------------------------------------

Route::apiResource('alertas', AlertaController::class);

// ----------------------------------------
// ROTAS DE HISTÓRICO (Registro de Ações)
// ----------------------------------------

Route::apiResource('historicos', HistoricoController::class);

// ----------------------------------------
// ROTAS DE RESERVAS
// ----------------------------------------

Route::apiResource('reservas', ReservaController::class);

Route::prefix('reservas')->controller(ReservaController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');

    Route::get('/disponibilidade', 'verificarDisponibilidade');
    Route::post('/{id}/confirmar', 'confirmarReserva');
    Route::get('/morador/{nome}', 'porMorador');
    Route::get('/mes/{mes}/ano/{ano}', 'porPeriodo');
    Route::get('/estatisticas', 'estatisticas');
});

// ----------------------------------------
// ROTAS DE OCORRÊNCIAS
// ----------------------------------------

Route::apiResource('ocorrencia', OcorrenciaController::class);

Route::prefix('ocorrencias')->controller(OcorrenciaController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');

    Route::post('/{id}/responder', 'responder');
    Route::post('/{id}/resolver', 'resolver');
    Route::get('/morador/{nome}', 'porMorador');
    Route::get('/unidade/{unidade}', 'porUnidade');
    Route::get('/status/{status}', 'porStatus');
    Route::get('/estatisticas', 'estatisticas');
});

// ----------------------------------------
// ROTAS DE COMUNICADOS
// ----------------------------------------

Route::apiResource('comunicados', ComunicadoController::class);

Route::get('comunicados/publicados', [ComunicadoController::class, 'publicados']);
Route::get('comunicados/categoria/{categoria}', [ComunicadoController::class, 'porCategoria']);
Route::get('comunicados/autor/{autor_id}', [ComunicadoController::class, 'porAutor']);
Route::get('comunicados/busca/{termo}', [ComunicadoController::class, 'buscar']);
Route::get('comunicados/data/{inicio}/{fim}', [ComunicadoController::class, 'porPeriodo']);

// ----------------------------------------
// ROTAS DE FINANCEIRO
// ----------------------------------------

Route::get('/financeiro', [FinanceiroController::class, 'index']);
Route::post('/financeiro', [FinanceiroController::class, 'store']);
Route::get('/financeiro/{id}', [FinanceiroController::class, 'show']);
Route::put('/financeiro/{id}', [FinanceiroController::class, 'update']);
Route::patch('/financeiro/status/{id}', [FinanceiroController::class, 'atualizarStatus']);
Route::delete('/financeiro/{id}', [FinanceiroController::class, 'destroy']);

Route::get('/financeiro/mensal', [FinanceiroController::class, 'mensal']);
Route::get('/financeiro/resumo', [FinanceiroController::class, 'resumo']);
Route::get('/financeiro/pendentes', [FinanceiroController::class, 'pendentes']);
Route::get('/financeiro/pagas', [FinanceiroController::class, 'pagas']);

// ----------------------------------------
// ROTAS DE MORADORES
// ----------------------------------------

Route::prefix('moradores')->controller(MoradoresController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::post('/', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');

    Route::patch('/status/{id}', 'atualizarStatus');
    Route::get('/ativos', 'ativos');
    Route::get('/inativos', 'inativos');
});

// ----------------------------------------
// ROTAS DE BOLETOS
// ----------------------------------------

Route::apiResource('boleto', BoletoController::class);

Route::prefix('boletos')->controller(BoletoController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');

    Route::get('/{id}/pdf', 'gerarPdf');
    Route::post('/{id}/comprovante', 'enviarComprovante');
    Route::get('/{id}/simular-multa', 'simularMultaJuros');
    Route::post('/{id}/renegociar', 'renegociar');
    Route::get('/estatisticas', 'estatisticasPagamentos');
    Route::get('/historico/{ano}', 'historico');
});

// ----------------------------------------
// ROTAS DE ORDENS DE SERVIÇO
// ----------------------------------------

Route::prefix('ordens-servico')->controller(OrdemServicoController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});

// ----------------------------------------
// ROTAS DE VISITAS + PORTARIA DIGITAL
// ----------------------------------------

Route::prefix('portaria')->group(function () {
    Route::apiResource('visitas', VisitaController::class);
    Route::apiResource('prestadores', PrestadorController::class);
    Route::apiResource('autorizacoes', AutorizacaoController::class);
    Route::apiResource('encomendas', EncomendaController::class);
});

// ----------------------------------------
// ROTAS EXTRAS DE ENCOMENDAS (FUNCIONALIDADES ESPECIAIS)
// ----------------------------------------

use App\Http\Controllers\Api\EncomendasController;

// 🟢 Cadastro de nova encomenda
Route::post('/encomendas', [EncomendaController::class, 'store']);

// 📜 Listar histórico de encomendas
Route::get('/encomendas', [EncomendaController::class, 'index']);

// ✅ Confirmar retirada da encomenda
Route::post('/encomendas/{id}/confirmar', [EncomendaController::class, 'confirmarRetirada']);

// 📊 Relatório de encomendas (admin)
Route::get('/encomendas/relatorio', [EncomendaController::class, 'relatorio']);


//----------------------------------------------------------
// ROTAS DE RELATORIOS PERSONALIZADOS 
// ----------------------------------------------------------

Route::post('/relatorios/ocorrencias', [RelatorioController::class, 'ocorrencias']);

//
// ROTAS DE WHATSAPP 
//
Route::prefix('whatsapp')->controller(WhatsAppController::class)->group(function () {
    // Enviar mensagem via API externa (Z-API, Meta etc)
    Route::post('/send', 'send');

    // (Opcional) Histórico de mensagens enviadas
    Route::get('/historico', 'index');
});

//
// ROTAS DOS FUNCIONÁRIOS 
// 

Route::apiResource('funcionarios', FuncionarioController::class);

//
// ROTAS DO LOGIN
// 

Route::post('/login', function (Request $request) {
    $email = $request->input('email');
    $password = $request->input('password');

    // Usuário e senha fixos (exemplo)
    if ($email === '@amanda' && $password === '12345') {
        return response()->json([
            'status' => 'success',
            'token' => '123456abcdef' // token fictício
        ]);
    }

    return response()->json(['status' => 'error', 'message' => 'Usuário ou senha inválidos'], 401);
});


/* PARTE DO LOGIN*/ 

Route::post('/logout', function (Request $request) {
    
    return response()->json(['message' => 'Logged out'], 200);
});