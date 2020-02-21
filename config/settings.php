<?php

return [
    'pagination' => 10,

    'passport' => [
        'client_id' => env('CLIENT_ID', 2),
        'client_secret' => env('CLIENT_SECRET', 'JnuiZjBOsrAX8b40o1GySbGciRn0Nr4LJOJy0ryg'),
        'scope' => env('SCOPE', '*'),
        'grant_type' => env('GRANT_TYPE', 'password'),
    ]
];
