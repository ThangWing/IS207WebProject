<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', '/*'],
    'allowed_methods' => ['*'],
<<<<<<< HEAD

    'allowed_origins' => [env('http://127.0.0.1:5108', "http://127.0.0.1:8000/")],

=======
    'allowed_origins' => ['*'], //add your allowed origins
>>>>>>> d65468b12edfc20cb44dcb984cbec901261417a7
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,


];
