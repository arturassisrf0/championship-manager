<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/database.php';

use App\Core\Router;

$router = new Router();
require __DIR__ . '/../app/routes.php';

$script = $_SERVER['SCRIPT_NAME'];                
$base = rtrim(dirname($script), '/\\');          
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (str_starts_with($uri, $script)) {
    $uri = substr($uri, strlen($script));        
} elseif (str_starts_with($uri, $base)) {
    $uri = substr($uri, strlen($base));          
}

$uri = '/' . trim($uri, '/');                   

define('BASE_URL', $base);

$router->dispatch($_SERVER['REQUEST_METHOD'], $uri);

?>