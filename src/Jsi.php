<?php

namespace Asko\Js;

use Asko\Js\Attributes\JsInteropClass;
use Asko\Js\Attributes\JsInteropFunction;
use Asko\Js\Attributes\JsInteropMethod;
use Asko\Js\Jsi\Location;
use Asko\Js\Jsi\Traits\HasEventTarget;

#[JsInteropClass(name: 'window')]
class Jsi
{
    use HasEventTarget;

    public function alert(mixed $message): void {}

    #[JsInteropMethod(isProperty: true)]
    public function location(): Location {
        return new Location();
    }
}