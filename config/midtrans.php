<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Midtrans Server and Client Keys
    |--------------------------------------------------------------------------
    |
    | These keys are required to authenticate requests to Midtrans API.
    | You can find these keys in your Midtrans Dashboard under Settings > Access keys.
    |
    */

    'server_key' => env('MIDTRANS_SERVER_KEY', 'your_midtrans_server_key'),
    'client_key' => env('MIDTRANS_CLIENT_KEY', 'your_midtrans_client_key'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is_3ds' => env('MIDTRANS_IS_3DS', true),

    /*
    |--------------------------------------------------------------------------
    | Default Midtrans API Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the Midtrans API environment used for transactions.
    | Possible values: 'sandbox' or 'production'.
    |
    */

    'environment' => env('MIDTRANS_ENV', 'sandbox'),

    /*
    |--------------------------------------------------------------------------
    | Custom API URL
    |--------------------------------------------------------------------------
    |
    | Use this option if you need to override the default API URL provided by Midtrans.
    | Example: 'https://api.midtrans.com/v2/'
    |
    */

    'api_url' => env('MIDTRANS_API_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Snap Features
    |--------------------------------------------------------------------------
    |
    | Configuration options for Midtrans Snap features.
    |
    */

    'snap' => [
        /*
        |--------------------------------------------------------------------------
        | Enable/Disable Snap
        |--------------------------------------------------------------------------
        |
        | Whether to enable or disable Midtrans Snap feature.
        |
        */

        'enabled' => env('MIDTRANS_SNAP_ENABLED', true),

        /*
        |--------------------------------------------------------------------------
        | Credit Card Payment
        |--------------------------------------------------------------------------
        |
        | Configuration options for Credit Card payment through Snap.
        |
        */

        'credit_card' => [
            /*
            |--------------------------------------------------------------------------
            | Enable/Disable Credit Card Payment
            |--------------------------------------------------------------------------
            |
            | Whether to enable or disable Credit Card payment method.
            |
            */

            'enabled' => env('MIDTRANS_SNAP_CC_ENABLED', true),

            /*
            |--------------------------------------------------------------------------
            | Channel
            |--------------------------------------------------------------------------
            |
            | The payment channel to be used for Credit Card transactions.
            | Possible values: 'migs', 'vtweb', 'mandiri_clickpay', 'bca_klikbca', 'bca_klikpay',
            | 'bri_epay', 'cimb_clicks', 'danamon_online', 'gopay', 'indosat_dompetku', 'kioson',
            | 'kredivo', 'mandiri_ecash', 'permata_va', 'akulaku', 'dana', 'ovo', 'shopeepay', 'linkaja'
            |
            */

            'channel' => 'migs',
        ],

        /*
        |--------------------------------------------------------------------------
        | Other Configuration Options
        |--------------------------------------------------------------------------
        |
        | Add any other Snap configuration options as needed.
        |
        */
    ],
];
