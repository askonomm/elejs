<?php

namespace Asko\Js\Attributes;

#[\Attribute]
class JsInteropFunction
{
    public function __construct(public ?string $name = null) {}
}