<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WhatsAppController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $verifyToken = 'my_secure_token';

        if ($request->isMethod('get') && $request->input('hub_mode') === 'subscribe' && $request->input('hub_verify_token') === $verifyToken) {
            return response($request->input('hub_challenge'), 200);
        }

        Log::info('Webhook received: ' . json_encode($request->all()));
        return response()->json(['status' => 'success'], 200);
    }

    public function sendMessage(Request $request)
    {
        Log::info('sendMessage endpoint reached');

        $to = $request->input('to');
        $templateName = $request->input('templateName');
        $language = $request->input('language', 'en_US');
        $components = $request->input('components', []);

        Log::info('Sending message: ' . json_encode([
            'to' => $to,
            'templateName' => $templateName,
            'language' => $language,
            'components' => $components,
        ]));

        return response()->json(['status' => 'success'], 200);
    }
}
