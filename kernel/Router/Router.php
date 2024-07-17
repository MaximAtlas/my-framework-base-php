<?php

namespace App\Kernel\Router;

use App\Kernel\Auth\AuthInterface;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\SessionInterface;
use App\Kernel\View\ViewInterface;

class Router implements RouterInterface
{
    private $routes = [
        'GET' => [],
        'POST' => []];

    public function __construct(
        private ViewInterface $view,
        private RequestInterface $request,
        private RedirectInterface $redirect,
        private SessionInterface $session,
        private DatabaseInterface $database,
        private AuthInterface $auth,
    ) {
        $this->initRoutes();
    }

    public function dispatch(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);

        if (! $route) {
            $this->notFound();
        }
        if (is_array($route->getAction())) {
            [$controller, $action] = $route->getAction();
            $controller = new $controller();

            call_user_func([$controller, 'setSession'], $this->session);
            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRequest'], $this->request);

            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setDatabase'], $this->database);
            call_user_func([$controller, 'setAuth'], $this->auth);

            call_user_func([$controller, $action]);
        } else {
            call_user_func($route->getAction()); //тоже самое что и $route->getAction()()
        }

    }

    private function notFound()
    {
        echo '404';
        exit;
    }

    private function findRoute(string $uri, string $method): Routes|false
    {
        if (! isset($this->routes[$method][$uri])) {
            return false;
        }

        return $this->routes[$method][$uri];
    }

    private function getRoutes()
    {
        return require_once APP_PATH.'/config/routes.php';
    }

    private function initRoutes(): void
    {
        $getRoute = $this->getRoutes();
        foreach ($getRoute as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }
}
