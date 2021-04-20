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
            $result = $this->parseRouteURL($url, $route->getRouteURLArray());

            if ($result["success"]) {
                $route->execute($result["params"]);
            }
        }
    }

    private function parseRouteURL($requestURL, $routeURLArray)
    {
        $result = ["success" => false, "params" => []];

        $requestURLArray = explode(
            "/",
            preg_replace("/\/+/", "/", $requestURL)
        );

        if (sizeof($requestURLArray) !== sizeof($routeURLArray)) {
            return $result;
        }

        for ($i = 0; $i < sizeof($requestURLArray); $i++) {
            echo "$requestURLArray[$i] $routeURLArray[$i]";
            $matches = [];
            preg_match("/:(\w+)/", $routeURLArray[$i], $matches);

            if (isset($matches[1])) {
                $result["params"][$matches[1]] = $requestURLArray[$i];
                continue;
            }

            if ($requestURLArray[$i] !== $routeURLArray[$i]) {
                return $result;
            }
        }

        $result["success"] = true;
        return $result;
    }
}
