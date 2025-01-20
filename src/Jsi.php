<?php

namespace Asko\Js;

use Asko\Js\Attributes\JsInteropClass;
use Asko\Js\Jsi\Traits\HasEventTarget;

#[JsInteropClass(name: 'window')]
class Jsi
{
    use HasEventTarget;

    public function alert(mixed $message): void {}
}