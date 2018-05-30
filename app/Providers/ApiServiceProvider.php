<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('internalError', function ($message, $trace, $httpCode = 500) {
            $data = array();
            $data['message'] = $message;
            if ($trace) {
                $data['stack_trace'] = $trace;
            }
            return response()->json($data, $httpCode);
        });

        Response::macro('error', function ($message, $httpCode = 400) {
            $data = array();
            $data['message'] = $message;
            $data['status_code'] = $httpCode;
            return response()->json($data, $httpCode);
        });

        Response::macro('success', function ($response, $httpCode = 200) {
            $data = array();
            $data['success'] = true;
            $data['data'] = $response;
            return response()->json($data, $httpCode);
        });
    }
}
