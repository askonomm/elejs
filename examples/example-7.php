<?php

namespace Asko\Elefe\Js;

class Router
{
    private array $routes = [];

    public function addRoute($route): void
    {
        $this->routes[] = $route;
    }
}