<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function testPost(Request $request)
    {
        Log::info('testPost endpoint reached');
        
        $data = $request->all();
        Log::info('Data received: ' . json_encode($data));
        
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }
}
