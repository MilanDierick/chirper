<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Laravel\Nova\Exceptions\NovaExceptionHandler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class NovaExceptionHandler extends ExceptionHandler
{
    public function render($request, Throwable $e): JsonResponse|Response
    {
        if ($e instanceof ValidationException) {
            return response()->json([
                'errors' => $e->errors(),
            ], 422);
        }

        return parent::render($request, $e);
    }
}
