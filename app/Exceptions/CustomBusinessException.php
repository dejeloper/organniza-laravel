<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class CustomBusinessException extends Exception
{
    public function __construct(string $message = "Ocurrió un error de negocio", int $code = 400)
    {
        parent::__construct($message, $code);
    }

    /**
     * Devuelve la respuesta HTTP cuando esta excepción es lanzada.
     */
    public function render(): JsonResponse
    {
        return response()->json([
            'error' => $this->getMessage(),
        ], $this->getCode());
    }
}
