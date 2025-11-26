<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SupabaseFallback
{
    /**
     * Get records from Supabase REST API for the specified table.
     */
    private function getFromRest(string $table, array $params = []): ?array
    {
        $projectRef = env('AWS_ACCESS_KEY_ID'); // we reuse this as the project ref in env
        $serviceKey = env('SUPABASE_SERVICE_ROLE_KEY');
        if (! $projectRef || ! $serviceKey) {
            return null;
        }

        $baseUrl = "https://{$projectRef}.supabase.co/rest/v1/" . $table;
        $headers = [
            'apikey' => $serviceKey,
            'Authorization' => 'Bearer ' . $serviceKey,
            'Accept' => 'application/json',
        ];

        $response = Http::withHeaders($headers)->get($baseUrl, $params);
        if (! $response->ok()) {
            return null;
        }

        return $response->json();
    }

    /**
     * Fetch featured products via Supabase REST as a fallback when the primary DB is unreachable.
     */
    public function getFeaturedProducts(int $limit = 6)
    {
        $params = [
            'select' => 'id,name,slug,description,base_price,image_path,current_stock,status,created_at',
            'status' => 'eq.active',
            'order' => 'created_at.desc',
            'limit' => $limit,
        ];

        $data = $this->getFromRest('products', $params);
        if (! $data) {
            return null;
        }

        // Convert arrays to stdClass objects for compatibility in views
        return collect($data)->map(function ($item) {
            return (object) $item;
        });
    }

    public function getAnnouncements(int $limit = 3)
    {
        $params = [
            'select' => 'id,title,body,pinned,created_at',
            'pinned' => 'eq.true',
            'order' => 'created_at.desc',
            'limit' => $limit,
        ];

        $data = $this->getFromRest('announcements', $params);
        if (! $data) {
            return null;
        }

        return collect($data)->map(function ($item) {
            return (object) $item;
        });
    }
}
