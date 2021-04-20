<?php
class Route {
    public function __construct(private string $url, private string $method, private $callback)
    {}

    public function getRouteURL(): string {
        return $this->url;
    }

    public function execute() {
        return call_user_func($this->callback);
    }
}