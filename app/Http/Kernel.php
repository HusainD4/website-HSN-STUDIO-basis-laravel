?php

protected $routeMiddleware = [
    // ...
    'admin.only' => \App\Http\Middleware\AdminOnly::class,
];
