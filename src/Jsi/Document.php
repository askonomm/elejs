<?php

namespace Asko\Elejs\Jsi;

use Asko\Elejs\Attributes\JsInteropClass;
use Asko\Elejs\Jsi\Traits\HasEventTarget;
use Asko\Elejs\Jsi\Traits\Queryable;

#[JsInteropClass(name: "document")]
class Document
{
    use HasEventTarget;
    use Queryable;
}