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
        $serviceKey = env('SUPABASE_SERVICE_ROLE_KEY') ?: env('SUPABASE_ANON_KEY');
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
            // Try local fallback file
            $local = $this->readLocalFallback('products');
            if ($local) {
                return $local->take($limit);
            }
            return null;
        }

        // Convert arrays to stdClass objects for compatibility in views
        // Convert items to objects and ensure image_url property is added
        return collect($data)->map(function ($item) {
            $obj = (object) $item;
            // If Supabase uses path in image_path, but we want full URL, try to convert
            if (isset($obj->image_path) && $obj->image_path && str_starts_with($obj->image_path, 'http')) {
                $obj->image_url = $obj->image_path;
                unset($obj->image_path);
            }
            // Ensure numeric casts
            $obj->base_price = isset($obj->base_price) ? (float)$obj->base_price : 0.0;
            $obj->current_stock = isset($obj->current_stock) ? (int)$obj->current_stock : 0;
            return $obj;
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
            $local = $this->readLocalFallback('announcements');
            if ($local) {
                return $local->take($limit);
            }
            return null;
        }

        return collect($data)->map(function ($item) {
            return (object) $item;
        });
    }

    // Generic product list with pagination support (offset + limit)
    public function getProducts(array $filters = [], int $limit = 12, int $offset = 0)
    {
        // Build params for supabase REST
        $params = [
            'select' => 'id,name,slug,description,base_price,image_path,current_stock,status,created_at',
            'limit' => $limit,
            'offset' => $offset,
        ];

        if (isset($filters['status'])) {
            $params['status'] = 'eq.' . $filters['status'];
        }
        if (isset($filters['search'])) {
            $params['name'] = 'ilike.*' . $filters['search'] . '*';
        }
        if (isset($filters['order'])) {
            $params['order'] = $filters['order'];
        }

        $data = $this->getFromRest('products', $params);
        if (! $data) {
            return null;
        }
        return collect($data)->map(function ($item) {
            return (object) $item;
        });
    }

    public function getProductBySlug(string $slug)
    {
        $params = [
            'select' => '*',
            'slug' => 'eq.' . $slug,
            'limit' => 1,
        ];

        $data = $this->getFromRest('products', $params);
        if (! $data || count($data) === 0) {
            return null;
        }
        return (object) $data[0];
    }

    public function getVariantsForProduct(int $productId)
    {
        $params = [
            'select' => '*',
            'product_id' => 'eq.' . $productId,
        ];

        $data = $this->getFromRest('product_variants', $params);
        if (! $data) {
            // No local fallback for variants currently
            return null;
        }
        return collect($data)->map(function ($item) {
            return (object) $item;
        });
    }

    private function readLocalFallback(string $type)
    {
        try {
            $path = storage_path("app/public/fallback/{$type}.json");
            if (!file_exists($path)) {
                return null;
            }
            $content = file_get_contents($path);
            if (! $content) return null;
            $json = json_decode($content, true);
            if (! $json) return null;
            return collect($json)->map(fn($i) => (object)$i);
        } catch (\Throwable $e) {
            logger()->warning('Failed reading local fallback ' . $type . ': ' . $e->getMessage());
            return null;
        }
    }
}
