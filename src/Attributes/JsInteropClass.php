<?php

namespace Asko\Elejs\Attributes;

#[\Attribute]
class JsInteropClass
{
    public function __construct(public ?string $name = null) {}
}