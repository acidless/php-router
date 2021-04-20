<?php

$router = new Router(function ($e) {
    echo $e->getMessage();
});

$router->GET("/test/:id", function ($params) {
    echo "test";
    echo $params["id"];
});
