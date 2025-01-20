<?php

namespace Asko\Js\Jsi\Traits;

trait HasEventTarget
{
    /**
     * @param string $type
     * @param callable $listener
     * @param array|null $options
     * @return void
     */
    public function addEventListener(string $type, callable $listener, ?array $options = null): void
    {}

    /**
     * @param string $type
     * @param callable $listener
     * @return void
     */
    public function removeEventListener(string $type, callable $listener): void
    {}
}