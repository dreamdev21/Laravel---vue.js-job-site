<?php

return [
  'mode' => env('PAYPAL_MODE', 'live'),

  'client_id' => env('PAYPAL_CLIENT_ID'),

  'client_secret' => env('PAYPAL_CLIENT_SECRET'),

  'log' => [
    'LogEnabled' => env('PAYPAL_LOG_ENABLE', true),
    'FileName' => storage_path('logs/paypal.log'),
    'LogLevel' => env('PAYPAL_LOG_LEVEL', 'DEBUG')
  ]
];
