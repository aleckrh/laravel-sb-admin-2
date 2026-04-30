<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());

// $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// $response = $kernel->handle(
//     $request = Illuminate\Http\Request::capture()
// );

// $response->send();

// $kernel->terminate($request, $response);
