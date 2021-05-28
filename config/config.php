<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Bizzcloud url
    |--------------------------------------------------------------------------
    |
    | The server url is the instance’s domain (e.g. https://mycompany.bizzcloud.nl)
    |
    */

    'url' => env('BIZZ_URL'),

    /*
    |--------------------------------------------------------------------------
    | Bizzcloud database
    |--------------------------------------------------------------------------
    |
    | the database name is the name of the instance (e.g. mycompany).
    | You can create or use a existing user with enough rights to access the different documents.
    |
    */

    'db' => env('BIZZ_DB'),

    /*
    |--------------------------------------------------------------------------
    | Bizzcloud username
    |--------------------------------------------------------------------------
    |
    | Is the username where you logged in on the website.
    |
    */

    'username' => env('BIZZ_USERNAME'),

    /*
    |--------------------------------------------------------------------------
    | Bizzcloud password
    |--------------------------------------------------------------------------
    |
    | Is the password where you logged in on the website.
    |
    */
    'password' => env('BIZZ_PASSWORD'),
];
