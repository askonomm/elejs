<?php

namespace Asko\Js;

use Asko\Js\Attributes\JsInterop;

class Jsi
{
    #[JsInterop]
    public static function alert(mixed $message): void
    {}

    public static function _alert(mixed $message): string
    {
        return "alert(\"$message\")";
    }
}