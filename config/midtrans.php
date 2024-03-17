<?php

return [
    "is_production" => env('MIDTRANS_PRODUCTION', 0),
    "client_key" => env('MIDTRANS_PRODUCTION') == 1 ? env('MIDTRANS_CLIENT_KEY_PROD') : env('MIDTRANS_CLIENT_KEY_STG'),
    "server_key" => env('MIDTRANS_PRODUCTION') == 1 ? env('MIDTRANS_SERVER_KEY_PROD') : env('MIDTRANS_SERVER_KEY_STG'),
    "merchant_id" => env('MIDTRANS_PRODUCTION') == 1 ? env('MIDTRANS_MERCHANT_ID_PROD') : env('MIDTRANS_MERCHANT_ID_STG'),
    'token' => env('MIDTRANS_PRODUCTION') == 1 ? base64_encode(env('MIDTRANS_SERVER_KEY_PROD') . ':') : base64_encode(env('MIDTRANS_SERVER_KEY_STG') . ':'),
    'url' => env('MIDTRANS_PRODUCTION') == 1 ? env('MIDTRANS_URL_PROD')  : env('MIDTRANS_URL_STG'),
];
