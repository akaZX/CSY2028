<?php
namespace CSY2028;
class EntryPoint {
	private $routes;

    public function __construct(\CSY2028\Routes $routes) {
        $this->routes = $routes;
    }

    public function run() {
        $route = ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');

        $routes = $this->routes->callControllerAction();

        $method = $_SERVER['REQUEST_METHOD'];

// triggers functions in Routes controller to check eligibility to access admin menu 
        if(isset($routes[$route]['loggedin'])) {
            $this->routes->loggedin();
        }

        if(isset($routes[$route]['privil'])) {
            $this->routes->privil($routes[$route]['privil']);
        }

        $controller = $routes[$route][$method]['controller'];
        $functionName = $routes[$route][$method]['function'];

        $page = $controller->$functionName();

        $output = $this->loadTemplate('../templates/' . $page['template'], $page['variables']);
        $title = 'Fran\'s Furniture - '.$page['title'];
        require '../templates/layout.html.php';
    }

    public function loadTemplate($fileName, $templateVars) {
        extract($templateVars);
        ob_start();
        require $fileName;
        $contents = ob_get_clean();
        return $contents;
    }
}