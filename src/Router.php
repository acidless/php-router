<?php
require_once "RouteHandler.php";

class Router
{
    private array $routes;
    private RouteHandler $routeHandler;
    private $notFoundHandler;

    public function __construct($notFoundHandler = null)
    {
        $this->routeHandler = new RouteHandler();
        if ($notFoundHandler) {
            $this->notFoundHandler = $notFoundHandler;
        }
    }

    public function resolveRoutes()
    {
        try {
            $this->routeHandler->checkRoutes($this->routes);
        } catch (NotFoundException $e) {
            call_user_func($this->notFoundHandler, $e);
        }
    }

    public function GET($url, $callback)
    {
        $this->addRoute($url, "GET", $callback);
    }

    public function POST($url, $callback)
    {
        $this->addRoute($url, "POST", $callback);
    }

    public function PATCH($url, $callback)
    {
        $this->addRoute($url, "PATCH", $callback);
    }

    public function PUT($url, $callback)
    {
        $this->addRoute($url, "PUT", $callback);
    }

    public function DELETE($url, $callback)
    {
        $this->addRoute($url, "DELETE", $callback);
    }

    private function addRoute($url, $method, $callback)
    {
        $this->routes[] = new Route($url, $method, $callback);
    }

    public function onNotFound($callback)
    {
        $this->notFoundHandler = $callback;
    }
}
