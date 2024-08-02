<?php





namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WhatsAppController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $verifyToken = 'my_secure_token'; // Debe coincidir con el token ingresado en la consola de WhatsApp

        if ($request->isMethod('get') && $request->input('hub_mode') === 'subscribe' && $request->input('hub_verify_token') === $verifyToken) {
            return response($request->input('hub_challenge'), 200);
        }

        $this->logToFile('Webhook received: ' . json_encode($request->all()));

        return response()->json(['status' => 'success'], 200);
    }

    public function sendMessage(Request $request)
    {
        $this->logToFile('sendMessage endpoint reached');

        $to = $request->input('to');
        $templateName = $request->input('templateName');
        $language = $request->input('language', 'en_US');
        $components = $request->input('components', []);

        $this->logToFile('Sending message: ' . json_encode([
            'to' => $to,
            'templateName' => $templateName,
            'language' => $language,
            'components' => $components,
        ]));

        return response()->json(['status' => 'Message sent']);
    }

    private function logToFile($message)
    {
        $logFile = public_path('webhook_log.txt');
        file_put_contents($logFile, date('Y-m-d H:i:s') . ' ' . $message . PHP_EOL, FILE_APPEND);
    }
}
