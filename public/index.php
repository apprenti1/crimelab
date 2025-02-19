<?php
try {
    $basepath = '../';
    require_once '../system/Utilities.php';

    require $basepath.'vendor/autoload.php';

    Utilities::loadEnv();
    Utilities::generateKey();
    Utilities::$basepath = $basepath;
    $baseurl = $_ENV['BASEURL'];
    Utilities::$baseurl = $basepath;
    function load_route($route) {
        // Chemin du fichier de la route
        $routeFile = __DIR__ . '/../src/route/' . $route . '.php';
        
        Utilities::$baseurl .= str_repeat('../', substr_count($route, '/'));
        if (file_exists($routeFile)) {
            require_once $routeFile;

        } else {
            $title = 'error: 404';
            require_once __DIR__ . '/assets/error/404.php';
        }
    }
    function get_route(){
        // Récupération de la route depuis l'URL
        $request_uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $script_name = trim(dirname($_SERVER['SCRIPT_NAME']), '/');

        if ($script_name) {
            $request_uri = preg_replace('/^' . preg_quote($script_name, '/') . '/', '', $request_uri);
        }

        $request_uri = trim($request_uri, '/');
        $route = $request_uri ? $request_uri : 'home';
        return $route;
    }

    $route = get_route();


    load_route($route);
} catch (Exception $e) {
    $title = 'error: 503';
    require_once __DIR__ . '/assets/error/503.php';
}

?>