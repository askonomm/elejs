<?php

namespace Asko\Elejs\Attributes;

#[\Attribute]
class JsInteropMethod
{
    public function __construct(public bool $isProperty = false) {}
}