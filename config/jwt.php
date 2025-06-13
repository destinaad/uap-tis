<?php

return [
    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Secret
    |--------------------------------------------------------------------------
    |
    | Don't forget to set this in your .env file, otherwise your tokens
    | won't be as secure.
    |
    */
    'secret' => env('JWT_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication TTL
    |--------------------------------------------------------------------------
    |
    | Specify the length of time in minutes that the token will be
    | considered valid.
    |
    */
    'ttl' => env('JWT_TTL', 60), // Token berlaku 60 menit (1 jam)

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Refresh TTL
    |--------------------------------------------------------------------------
    |
    | Specify the length of time in minutes that the token can be refreshed
    | from the original `ttl` time.
    |
    */
    'refresh_ttl' => env('JWT_REFRESH_TTL', 20160), // Bisa di-refresh selama 2 minggu

    /*
    |--------------------------------------------------------------------------
    | JWT Authentication Algo
    |--------------------------------------------------------------------------
    |
    | The signing algorithm used to sign the token.
    |
    | Supported: "HS256", "HS384", "HS512", "RS256", "RS384", "RS512"
    |
    */
    'algo' => env('JWT_ALGO', 'HS256'),
];