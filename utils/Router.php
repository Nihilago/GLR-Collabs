<?php
class Router
{
    private $routes = [];

    public function addRoute($method, $path, $controller, $action)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function dispatch()
    {
        // 1. Raw path uit URL ophalen
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // 2. Base path bepalen uit SCRIPT_NAME
        $scriptName = $_SERVER['SCRIPT_NAME'];       // bv: /collabs/index.php
        $basePath   = rtrim(dirname($scriptName), '/'); // bv: /collabs

        // 3. Base path strippen
        if ($basePath !== '' && strpos($requestUri, $basePath) === 0) {
            $requestUri = substr($requestUri, strlen($basePath));
        }

        // 4. Normalize empty
        if ($requestUri === '' || $requestUri === false) {
            $requestUri = '/';
        }

        // 4b. /index.php als root behandelen
        if ($requestUri === '/index.php') {
            $requestUri = '/';
        }

        // 5. Trailing slash verwijderen (maar niet voor root)
        if ($requestUri !== '/' && substr($requestUri, -1) === '/') {
            $requestUri = rtrim($requestUri, '/');
        }

        // 6. Methode ophalen
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // 7. Router matchen
        foreach ($this->routes as $route) {
            // Debug kun je zo laten:
            // var_dump($route['path'], $requestUri);

            if ($route['method'] === $requestMethod && $route['path'] === $requestUri) {
                $controllerName = $route['controller'];
                $actionName     = $route['action'];

                require_once "controllers/{$controllerName}.php";
                $controller = new $controllerName();
                $controller->$actionName();
                return;
            }
        }

        // 8. 404
        http_response_code(404);
        require_once 'views/404.php';
    }
}
