<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ThrottleRequests
{
    public function handle(Request $request, Closure $next)
    {
        // Установите лимит в 10 запросов за 1 минуту
        $maxAttempts = 10;
        $decayMinutes = 1;

        // Используйте метод throttle
        $key = $request->ip(); // Или другой уникальный ключ, например, сессия пользователя

        // Проверка на превышение лимита запросов
        if ($this->hasTooManyAttempts($key, $maxAttempts)) {
            return response()->json(['error' => 'Too many requests.'], 429);
        }

        // Увеличиваем количество попыток
        $this->incrementAttempts($key);

        return $next($request);
    }

    protected function hasTooManyAttempts($key, $maxAttempts)
    {
        // Проверяем, превысили ли мы лимит
        return cache()->has($key) && cache()->get($key) >= $maxAttempts;
    }

    protected function incrementAttempts($key)
    {
        // Увеличиваем количество попыток
        cache()->increment($key);
        cache()->put($key, cache()->get($key), 60); // Установите время жизни ключа в 1 минуту
    }
}
