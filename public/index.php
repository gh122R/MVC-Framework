<?php

declare(strict_types=1);

session_start();
require_once '../vendor/autoload.php';

header("Cross-Origin-Opener-Policy: same-origin-allow-popups");
header("Cross-Origin-Embedder-Policy: credentialless");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use App\Router;

$router = new Router();

$router->register('/', [App\Controllers\HomeController::class, 'create'], [AuthMiddleware::class])
       ->register('/login', [App\Controllers\Auth\AuthController::class, 'login'])
       ->register('/register', [App\Controllers\Auth\AuthController::class, 'register'])
       ->register('/logout', [App\Controllers\Auth\AuthController::class, 'logout'],  [AuthMiddleware::class])
       ->register('/admin-panel', [App\Controllers\AdminController::class, 'index'],  [AuthMiddleware::class, [RoleMiddleware::class, 'admin || moderator']]);

try {
    echo $router->resolve($_SERVER['REQUEST_URI']);
} catch (Exception) {
    exit();
}
