<?php

namespace Asko\Js;

use Asko\Js\Attributes\JsInterop;

class Jsi
{
    #[JsInterop]
    public static function alert(mixed $message): void
    {}
}