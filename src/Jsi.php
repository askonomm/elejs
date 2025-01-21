<?php

namespace Asko\Elejs;

use Asko\Elejs\Jsi\Window;
use Asko\Elejs\Attributes\JsInteropClass;

#[JsInteropClass(name: 'window')]
class Jsi extends Window
{
}