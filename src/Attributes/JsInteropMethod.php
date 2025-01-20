<?php

namespace Asko\Js\Attributes;

#[\Attribute]
class JsInteropMethod
{
    public function __construct(public bool $isProperty = false) {}
}