<?php

namespace Asko\Js;

use Asko\Js\Attributes\JsInteropFunction;

class Jsi
{
    #[JsInteropFunction]
    public static function alert(mixed $message): void {}
}