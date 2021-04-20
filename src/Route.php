<?php
class Route {
    public function __construct(private string $url, private string $method, private $callback)
    {}

    public function getRouteURLArray() {
        return explode("/", preg_replace("/\/+/", "/", $this->url));
    }

    public function execute(array $params) {
        return call_user_func($this->callback, $params);
    }
}