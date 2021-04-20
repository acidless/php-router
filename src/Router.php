<?php
require_once "RouteHandler.php";

class Router
{
    private array $routes;
    private RouteHandler $routeHandler;
    private string $notFoundHandler;

    public function __construct($notFoundHandler)
    {
        $this->routeHandler = new RouteHandler();
        $this->notFoundHandler = $notFoundHandler;
    }

    public function checkRoutes()
    {
        $this->routeHandler->checkRoutes($this->routes);
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
