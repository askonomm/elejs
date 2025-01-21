<?php

namespace Asko\Elejs\Jsi;

use Asko\Elejs\Attributes\JsInteropClass;
use Asko\Elejs\Jsi\Traits\HasEventTarget;
use Asko\Elejs\Jsi\Traits\Queryable;

#[JsInteropClass]
class Element
{
    use HasEventTarget;
    use Queryable;
}