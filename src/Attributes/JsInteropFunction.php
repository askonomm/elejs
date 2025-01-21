<?php

namespace Asko\Elejs\Attributes;

#[\Attribute]
class JsInteropFunction
{
    public function __construct(public ?string $name = null) {}
}