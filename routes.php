<?php

$router = new Router();

$router->GET("/test/:id", function ($params) {
    echo "test";
    echo $params["id"];
});
