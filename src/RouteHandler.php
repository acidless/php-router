<?php
include_once "Route.php";
include_once "utils/NotFoundException.php";

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
                return $route->execute($result["params"]);
            }

            throw new NotFoundException(
                "There is no route defined for this request!"
            );
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
