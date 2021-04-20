<?php
include_once "Route.php";

class RouteHandler
{
    /**
     * @param Route[] $routes
     */
    public function checkRoutes(array $routes)
    {
        $url = $_SERVER["REQUEST_URI"];

        foreach ($routes as $route) {
            if ($route->getRouteURL() === $url) {
                $route->execute();
            }
        }
    }
}
