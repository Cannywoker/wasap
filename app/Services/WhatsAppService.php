<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WhatsAppController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $verifyToken = 'my_secure_token'; // Debe coincidir con el token ingresado en la consola de WhatsApp

        if ($request->isMethod('get') && $request->hub_mode === 'subscribe' && $request->hub_verify_token === $verifyToken) {
            return response($request->hub_challenge, 200);
        }

        // Generar un log manualmente para verificar
        Log::info('Webhook received: ', $request->all());

        return response()->json(['status' => 'success'], 200);
    }

    public function sendMessage(Request $request)
    {
        $to = $request->input('to');
        $templateName = $request->input('templateName');
        $language = $request->input('language', 'en_US');
        $components = $request->input('components', []);

        // Aquí iría el código para enviar el mensaje usando el servicio de WhatsApp

        // Generar un log manualmente para verificar
        Log::info('Sending message: ', [
            'to' => $to,
            'templateName' => $templateName,
            'language' => $language,
            'components' => $components,
        ]);

        // Suponiendo que se envía el mensaje correctamente
        return response()->json(['status' => 'Message sent']);
    }
}
