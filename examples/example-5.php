<?php

class SomeClass
{
    private $someProperty = "";

    public function __construct($someProperty)
    {
        $this->someProperty = $someProperty;
    }

    public function getSomeProperty() {
        return $this->someProperty;
    }
}
