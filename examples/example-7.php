<?php

//namespace Asko\Elefe\Js;
//
//use PDO;
//
//class Router
//{
//    private array $routes = [];
//
//    public function addRoute($route): void
//    {
//        $this->routes[] = $route;
//    }
//}

class Test {
    public function do() {
        return new static();
    }

    public function do2() {
        return new self();
    }

    public function do3() {
        return new Test();
    }
}