<?php

use App\Exceptions\CustomExceptionHandler;
use App\Http\Middleware\ForceJsonResponse;
use Illuminate\Foundation\Application;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Spatie\Permission\Middleware\{RoleMiddleware, PermissionMiddleware, RoleOrPermissionMiddleware};

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Asegura respuestas JSON antes de otros middlewares
        $middleware->prepend(ForceJsonResponse::class);

        // Middleware para solicitudes frontend con Sanctum
        $middleware->append(EnsureFrontendRequestsAreStateful::class);

        // Alias para middlewares de Spatie Permission
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Respuesta personalizada para autenticación fallida
        $exceptions->render(
            fn(AuthenticationException $exception, $request) =>
            response()->json(['message' => 'Unauthenticated.'], 401)
        );

        // Manejo personalizado de excepciones (opcional)
        $exceptions->render(
            fn(\Throwable $exception, $request) =>
            CustomExceptionHandler::handle($exception)
        );
    });

return $app->create();
