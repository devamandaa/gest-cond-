<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Whatsapp;

class WhatsAppController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'message' => 'required|string',
            'morador_id' => 'nullable|exists:moradores,id'
        ]);

        // Envia a mensagem para o WhatsApp via Z-API ou outra integração
        $instanceId = env('ZAPI_INSTANCE');
        $token = env('ZAPI_TOKEN');

        $url = "https://api.z-api.io/instances/{$instanceId}/token/{$token}/send-text";

        $response = Http::post($url, [
            'phone' => '55' . $request->phone,
            'message' => $request->message
        ]);

        // Salva no banco de dados o histórico da mensagem enviada
        Whatsapp::create([
            'morador_id' => $request->morador_id,
            'telefone' => $request->phone,
            'mensagem' => $request->message
        ]);

        return response()->json([
            'status' => 'enviado',
            'whatsapp_response' => $response->json()
        ]);
    }
}
