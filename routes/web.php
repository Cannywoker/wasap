<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WhatsAppController;
use App\Http\Controllers\TestController;
Route::post('/send-message', [WhatsAppController::class, 'sendMessage']);
Route::get('/webhook', [WhatsAppController::class, 'handleWebhook']);
Route::post('/webhook', [WhatsAppController::class, 'handleWebhook']);
Route::post('/test-post', [TestController::class, 'testPost']);

Route::get('/', function () {
    return view('welcome');
});
