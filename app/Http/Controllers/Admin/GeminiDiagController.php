<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiDiagController extends Controller
{
    /**
     * Return a simple diagnostic: model config, API URL, and available models.
     * Protected admin-only route.
     */
    public function index()
    {
        $model = config('services.gemini.model');
        $apiKeySet = !empty(config('services.gemini.api_key'));
        $apiUrlBase = 'https://generativelanguage.googleapis.com/v1beta/models';

        $result = [
            'model_config' => $model,
            'api_url_base' => $apiUrlBase,
            'api_key_set' => $apiKeySet,
        ];

        if (!$apiKeySet) {
            return response()->json($result);
        }

        try {
            $res = Http::withHeaders(['Content-Type' => 'application/json'])
                ->get($apiUrlBase . '?key=' . config('services.gemini.api_key'));

            if (!$res->successful()) {
                Log::warning('GeminiDiag: failed to fetch models', ['status' => $res->status(), 'body' => $res->body()]);
                $result['models_fetch_status'] = $res->status();
                $result['models_fetch_body'] = $res->json();
                return response()->json($result, 200);
            }

            $data = $res->json();
            $modelNames = array_map(fn($m) => $m['name'] ?? ($m['id'] ?? null), $data['models'] ?? []);
            $result['available_models'] = $modelNames;
            return response()->json($result, 200);
        } catch (\Exception $e) {
            Log::warning('GeminiDiag: exception while fetching models', ['message' => $e->getMessage()]);
            $result['exception'] = $e->getMessage();
            return response()->json($result, 200);
        }
    }
}
