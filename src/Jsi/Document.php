<?php

namespace Asko\Js\Jsi;

use Asko\Js\Attributes\JsInterop;

#[JsInterop]
class Document
{
    public static function querySelector(string $selector): Element  {
        return new Element();
    }

    /**
     * @param string $selector
     * @return Element[]
     */
    public static function querySelectorAll(string $selector): array
    {
        return [];
    }
}