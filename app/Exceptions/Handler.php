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
        if ($request->segment(1) == 'api' || $request->ajax()) {
            if ($this->isHttpException($e)) {
                $message = 'Http exception occurred';
                switch ($e->getStatusCode()) {
                    case 404:
                        $message = 'Method not found';
                        break;
                    case 405:
                        $message = 'Method not allowed';
                        break;
                    case 401:
                        $message = 'Unauthorized';
                        break;
					case 501:
                        $message = 'Maintenance';
                        break;
                }

                return response()->json([
                    'request_id' => uniqid(),
                    'status' => 'failure',
                    'message' => $message,
                    'timestamp' => Carbon::now(),
                ], $e->getStatusCode());
            } else if ($e instanceof ModelNotFoundException) {
                $e = new NotFoundHttpException($e->getMessage(), $e);
                return response()->json([
                    'request_id' => uniqid(),
                    'status' => 'not found',
                    'message' => $e->getMessage(),
                    'timestamp' => Carbon::now(),
                ], $e->getStatusCode());
            }
        }

        if (!config('app.debug', false) && !$this->isHttpException($e)) {
            if ($request->segment(1) == 'api' || $request->ajax()) {
                return response()->json([
                    'request_id' => uniqid(),
                    'status' => 'failure',
                    'message' => 'Internal server error',
                    'timestamp' => Carbon::now(),
                ], 500);
            }

            return response()->view('errors.500', ['exception' => $e], 500);
        }

        return parent::render($request, $e);
    }
}
