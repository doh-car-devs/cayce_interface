<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'passport'=> [
        'login_endpoint' => "http://127.0.0.1:2021/oauth/token",
        'client_id' => 2,
        'client_secret' => "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiNmZlODk5ZTE0ZjJjYTgxNzQxZWY4MzI4Y2YzMDg3Y2M2ODcwODkyZGQ1YzZlMGMwYzgxNzdjYjRmMzM3ODY1NGIwMjMzNGNjMDRjMTYzZWIiLCJpYXQiOjE1ODg0ODM0ODEsIm5iZiI6MTU4ODQ4MzQ4MSwiZXhwIjoxNjIwMDE5NDgxLCJzdWIiOiI3Iiwic2NvcGVzIjpbXX0.rfYAz95D4fc5hVotJhQR-BcBLqrY-_gWIaoZ2joTLDBaFKSDM_LlelRoU2Zox2zIIrvHIkIFU7kgY23nDlPgsRNuJAFJ2ISw3aQc99mTvybsPuive8LzosrRQorirzTD0XZpDS1vthSoC4PX9MRkPpkMxFY-KyiRkyALvmME8Tsrv9paCAhHyBn1LxM4YIhtDauVvppD7Vy7gV44H7qCKjjS9XbX1T1BJAhTqU2_8c9n6bhvvRim-GP2G0V48PHn1u5USEq9-_AEFi9ODYhpOc2pQvMwlEnyYvQRSI0hBoA6QGg8pPJkktU_S88Qlj_UlKnQHIKaGGT2ZkYEKK59EYIwe8Ju7apGvk9zFNTd3U9FtoASYiKgRZy_vE_ELIdxFzEycJI5d5UR4GGB2emMl1EfvFml1WoDLTeWBLoDP087JuhznYwEzZzQBzUd6xUHcZvTypCakdvNkARXcpz8biJNBlhvQpAxfsccwFW3DZJgvU9rYnn2ctrjAJfnhLYgl53-5toRnuo5hDu6-Kk9Y1OHvVat--vHq885jcY80wYZkUdm_EdLzaq1xXGBchm8fT84uVvDT4cx2tZBqUqGytDXFpZvG7m9fM6qbfmOoI-pqzIlJYGFgZHHVR0Oq4dr1WyY4UN3c-tjv2KfI12gMyvkDn2B4e3p8sHq9Ihq_6o",
    ],

    'url_wfp' => env('URL_WFP'),
    'url_exporter' => env('URL_EXPORTER'),
    'url_inventory' => env('URL_Inventory'),
    'URL_Inventory_API' => env('URL_Inventory_API'),
    'auth_url' => 'http://192.168.224.68:2020',
    'url_interface' => 'http://192.168.224.68:2021',
    'url_sandbox' => env('URL_LocalSandbox_API'),
    'url_hr' => env('URL_HR'),


    // 'base_url' => 'http://192.168.224.68:2022',
    // 'auth_url' => 'http://192.168.224.68:2020',

    // KELVIN
    'covid' => env('URL_COVID'),
    // 'APP_VERSION' => env('APP_Version'),
    'APP_VERSION' => "β 1.0 - 4.27.21",
    'Copyright-year' => "2019 - 2021",
];
