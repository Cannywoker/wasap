<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WhatsAppController;

Route::match(['get', 'post'], '/webhook', [WhatsAppController::class, 'handleWebhook']);
Route::post('/send-message', [WhatsAppController::class, 'sendMessage']);


Route::get('/', function () {
    return view('welcome');
});
