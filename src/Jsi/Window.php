<?php

namespace Asko\Elejs\Jsi;

use Asko\Elejs\Attributes\JsInteropClass;
use Asko\Elejs\Attributes\JsInteropMethod;
use Asko\Elejs\Jsi\Location;
use Asko\Elejs\Jsi\Traits\HasEventTarget;

#[JsInteropClass(name: "window")]
class Window
{
    use HasEventTarget;

    public function alert(mixed $message): void {}

    #[JsInteropMethod(isProperty: true)]
    public function location(): Location {
        return new Location();
    }
}