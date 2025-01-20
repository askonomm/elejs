<?php

namespace Asko\Elefe\Js;

use Asko\Js\Jsi;
use Asko\Js\Jsi\Events\PopStateEvent;

class Router
{
    public static function dispatch() {
        (new Jsi)->addEventListener("popstate", function(PopStateEvent $event) {
            echo $event->state;
        });
    }
}

(new Jsi)->location()->pathName;