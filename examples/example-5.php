<?php

class ClassA {

}

class ClassB extends ClassA
{
    private $someProperty = "";

    public function __construct($someProperty)
    {
        $this->someProperty = $someProperty;
    }

    public function getSomeProperty() {
        return $this->someProperty;
    }

    public static function someStaticFn() {
        return ":)";
    }
}

(new ClassB("test 123"))->getSomeProperty();
