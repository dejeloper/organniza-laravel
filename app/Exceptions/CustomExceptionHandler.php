<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use PDOException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class CustomExceptionHandler
{
    public static function handle(Throwable $exception): JsonResponse
    {
        if ($exception instanceof CustomBusinessException) {
            return response()->json([
                'error' => $exception->getMessage(),
            ], $exception->getCode());
        }

        if ($exception instanceof ModelNotFoundException || $exception instanceof NotFoundHttpException) {
            Log::error('Excepción capturada', ['exception' => $exception]);
            return response()->json([
                'error' => 'El recurso solicitado no fue encontrado.',
            ], 404);
        }

        if ($exception instanceof QueryException || $exception instanceof PDOException) {
            return response()->json([
                'error' => 'Problemas con la base de datos. Intente de nuevo más tarde.'
            ], 500);
        }

        return response()->json([
            'error' => 'Ocurrió un error inesperado.',
            'message' => env('APP_DEBUG') ? $exception->getMessage() : null,
            'type' => get_class($exception),
        ], 500);
    }
}
