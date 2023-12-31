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
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],
    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' =>  env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('APP_URL') . '/auth/facebook/callback',
    ],
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('APP_URL') . '/auth/google/callback',
    ],
    'paytm-wallet' => [
        'env' => env('PAYTM_ENVIRONMENT'),
        'merchant_id' => env('PAYTM_MERCHANT_ID'),
        'merchant_key' => env('PAYTM_MERCHANT_KEY'),
        'merchant_website' => env('PAYTM_MERCHANT_WEBSITE'),
        'channel' => env('PAYTM_CHANNEL'),
        'industry_type' => env('PAYTM_INDUSTRY_TYPE'),
    ],
    'agora' => [
        'app_id' => env('AGORA_APP_ID'),
        'app_certificate' => env('AGORA_APP_CERTIFICATE')
    ],
    'firebase' => [
        'server_key' => env("FIREBASE_SERVER_KEY"),
        'api_key' => env("FIREBASE_API_KEY"),
        'auth_domain' => env("FIREBASE_Auth_Domain"),
        'project_id' => env("FIREBASE_Project_Id"),
        'storage_bucket' => env("FIREBASE_Storage_Bucket"),
        'messaging_sender_id' => env("FIREBASE_Messaging_Sender_Id"),
        'app_id' => env("FIREBASE_App_Id"),
        'measurement_id' => env("FIREBASE_Measurement_Id")
    ],
    'google_maps_api_key' => env("GOOGLE_MAPS_API_KEY"),

    'pusher' => [
        'channel_name' => env('PUSHER_APP_CHANNEL_NAME'),
        'pusher_event_name' => env('PUSHER_APP_EVENT_NAME'),
    ],


];
