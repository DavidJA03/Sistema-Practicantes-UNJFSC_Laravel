<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
        protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];
    
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

  public function render($request, Throwable $exception)
{
    if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
        $statusCode = $exception->getStatusCode();

        if ($statusCode == 401) {
            return response()->view('errors.401', [], 401);
        } elseif ($statusCode == 403) {
            return response()->view('errors.403', [], 403);
        } elseif ($statusCode == 404) {
            return response()->view('errors.404', [], 404);
        } elseif ($statusCode == 500) {
            return response()->view('errors.500', [], 500);
        }
    }
    return parent::render($request, $exception);
}


}
