<?php

$version = env('ASAAS_API_VERSION');

return [
    'sandbox' => [
        'url' => env('ASAAS_SANDBOX_URL') . '/' . $version,
        'token' => env('ASAAS_SANDBOX_TOKEN'),
        'webhook' => env('ASAAS_WEBHOOK_TOKEN_SANDBOX'),

    ],
    'production' => [
        'url' => env('ASAAS_PRODUCTION_URL') . '/' . $version,
        'token' => env('ASAAS_PRODUCTION_TOKEN'),
        'webhook' => env('ASAAS_WEBHOOK_TOKEN_PRODUCTION'),
    ],
];