<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User; // Используем модель User для поиска ключа

class CustomCorsMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $origin = $request->header('Origin');
        $apiKey = $request->header('X-API-Key') ?? $request->input('api_key');

        $user = $this->getUserByApiKey($apiKey);

        if (!$user) {
            return response('Unauthorized (Invalid API Key)', 401);
        }

        if ($origin && !$this->isOriginAllowedForUser($origin, $user)) {
            return response('Forbidden (Origin not allowed for this API key)', 403);
        }

        $response = $next($request);


        $corsOrigin = $origin ?? '*';

        $response->withHeaders([
            'Access-Control-Allow-Origin' => $corsOrigin,
            'Access-Control-Allow-Methods' => 'GET, POST, OPTIONS',
            'Access-Control-Allow-Headers' => 'Content-Type, Accept, X-API-Key, X-Requested-With', 
        ]);

        return $response;
    }

    
    private function getUserByApiKey(?string $apiKey): ?User
    {
        if (!$apiKey) {
            return null;
        }
        return User::where('api_key', $apiKey)->first();
    }

    private function isOriginAllowedForUser(?string $origin, User $user): bool
    {
        // Проверяем, есть ли такой домен в списке доменов пользователя
        return $user->userdomains()->where('domain_url', $origin)->exists();
    }
}
