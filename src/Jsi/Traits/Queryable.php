<?php

namespace Asko\Elejs\Jsi\Traits;

use Asko\Elejs\Jsi\Element;

trait Queryable
{
    /**
     * @param string $selectors
     * @return Element
     */
    public function querySelector(string $selectors): Element  {
        return new Element();
    }

    /**
     * @param string $selectors
     * @return Element[]
     */
    public function querySelectorAll(string $selectors): array
    {
        return [];
    }
}