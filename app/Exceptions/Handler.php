<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthenticationException::class,
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
        if ($request->expectsJson()) {
            $message = $this->getMessage($exception);
            if (app()->environment() !== 'production') {
                return response()->internalError($message, $exception->getTrace(), $this->getHttpCode($exception));
            } else {
                return response()->error($message, $this->getHttpCode($exception));
            }
        }
        if ($exception instanceof TokenMismatchException) {
            // return redirect()->route('login')->withErrors(['session token expired please login again']);
            return response()->json(['message' => 'Token expired'], 403);
        }
        return parent::render($request, $exception);
    }

    /**
     * @param Exception $e
     * @return string
     */
    protected function getMessage(Exception $e)
    {
        if ($e instanceof ValidationException) {
            $message = $e->validator->getMessageBag()->all();
        } else {
            $message = $e->getMessage();
        }
        return $message;
    }


    /**
     * Return the http code based on exception
     *
     * @param  \Exception  $exception
     * @return integer
     */
    protected function getHttpCode(Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return 404;
        }
        if ($exception instanceof AuthenticationException) {
            return 401;
        }
        if ($exception instanceof ValidationException) {
            return 422;
        }

        return 500;
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
            return response()->error('Unauthenticated.', 401);
        }

        return redirect()->guest('login');
    }
}
