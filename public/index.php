<?php
$basepath = '../';
require_once '../system/Utilities.php';

require $basepath.'vendor/autoload.php';

Utilities::loadEnv();
Utilities::generateKey();
function load_route($route) {
    // Chemin du fichier de la route
    $routeFile = __DIR__ . '/../src/route/' . $route . '.php';
    $baseurl = $_ENV['BASEURL'];
    //var_dump($route);
    
    $baseurl .= str_repeat('../', substr_count($route, '/'));
    if (file_exists($routeFile)) {
        require_once $routeFile;

    } else {
        $title = 'error: 404';
        require_once __DIR__ . '/assets/error/404.php';
    }
}
function get_route(){
    // Récupération de la route depuis l'URL
    $request_uri = trim($_SERVER['REQUEST_URI'], '/');
    $script_name = trim(dirname($_SERVER['SCRIPT_NAME']), '/');

    if ($script_name) {
        $request_uri = preg_replace('/^' . preg_quote($script_name, '/') . '/', '', $request_uri);
    }

    $request_uri = trim($request_uri, '/');
    $route = $request_uri ? $request_uri : 'home';
    return $route;
}

$route = get_route();


// Chargement de la route correspondante
load_route($route);
?>
