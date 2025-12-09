<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response; 
use App\Models\UserDomain;
use App\Models\User;

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

        // --- ИСПРАВЛЕНИЕ ЗДЕСЬ ---
        // Проверяем, является ли домен локальным
        $isLocal = str_contains($origin, '127.0.0.1') || str_contains($origin, 'localhost');

        // Если Origin отправлен, и он НЕ локальный, и его нет в разрешенных доменах пользователя - блокируем.
        if ($origin && !$isLocal && !$this->isOriginAllowedForUser($origin, $user)) {
            return response('Forbidden (Origin not allowed for this API key)', 403);
        }
        // -------------------------

        $response = $next($request);

        // Заголовки CORS
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
        // Убедитесь, что поле в БД называется именно 'api_key'
        return User::where('api_key', $apiKey)->first();
    }

    private function isOriginAllowedForUser(?string $origin, User $user): bool
    {
        // Проверяем, есть ли такой домен в списке доменов пользователя
        // Убедитесь, что связь называется userdomains() и поле в таблице называется domain_url
        return UserDomain::where('domain_url', $origin)->exists();
    }
}
