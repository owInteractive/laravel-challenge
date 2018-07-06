<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return $this->handleException($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }

    protected function handleException($request, Exception $exception) {

        if($exception instanceof ValidationException) {
            return response()->json(["error" => $exception->validator->errors()->getMessages()], 422);
        }

        if ($exception instanceof ModelNotFoundException) {
            $modelName = strtolower(class_basename($exception->getModel()));
            return response()->json(["error" => "Does not existe any {$modelName} with the specified identificator"], 404);
        }

        if($exception instanceof AuthenticationException) {
            return $this->unauthenticated($request, $exception);
        }

        if($exception instanceof AuthorizationException) {
            return response()->json(["error" => $exception->getMessage()], 403);
        }

        if($exception instanceof MethodNotAllowedHttpException) {
            return response()->json(["error" => "The specified method for the request is invalid"], 404);
        }

        if($exception instanceof NotFoundHttpException) {
            return response()->json(["error" => "The specified URL cannot be found"], 404);
        }

        if($exception instanceof HttpException) {
            return response()->json(["error" => $exception->getMessage()], $exception->getStatusCode());
        }

        if (config('app.debug')) {
            return parent::render($request, $exception);
        }

        return response()->json(["error" => "Unexpected exception. Try later."], 500);
    }
}
