<?php

namespace Infogue\Exceptions;

use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if($e instanceof ModelNotFoundException) {
            if($request->segment(1) == 'api' || $request->ajax()){
                $e = new NotFoundHttpException($e->getMessage(), $e);
                $result = collect([
                    'request_id' => uniqid(),
                    'status' => $e->getStatusCode(),
                    'timestamp' => Carbon::now(),
                ]);
                return response($result, $e->getStatusCode());
            }
        }

        if (!config('app.debug', false) && !$this->isHttpException($e)) {
            if($request->segment(1) == 'api' || $request->ajax()){
                $result = collect([
                    'request_id' => uniqid(),
                    'status' => 500,
                    'timestamp' => Carbon::now(),
                ]);
                return response($result, 500);
            }

            return response()->view('errors.500', ['exception' => $e], 500);
        }

        return parent::render($request, $e);
    }
}
