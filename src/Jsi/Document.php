<?php

namespace Asko\Js\Jsi;

use Asko\Js\Attributes\JsInteropClass;
use Asko\Js\Jsi\Traits\HasEventTarget;
use Asko\Js\Jsi\Traits\Queryable;

#[JsInteropClass(name: "document")]
class Document
{
    use HasEventTarget;
    use Queryable;
}