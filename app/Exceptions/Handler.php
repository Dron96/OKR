<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json(['errors' => 'Вы не авторизованы.'], 401);
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {
            switch ($exception->getModel()) {
                case 'App\Models\Goal':
                    return response()->json(['message' => 'Такой цели не существует'], 404);
                case 'App\Models\KeyResult':
                    return response()->json(['message' => 'Такого ключевого результата не существует'], 404);
                case 'App\User':
                    return response()->json(['message' => 'Такого пользователя не существует'], 404);
            }

        }
        if ($exception instanceof AuthorizationException) {
            return response()->json(['message' => 'У вас недостаточно прав'], 403);
        }

        return parent::render($request, $exception);
    }
}
