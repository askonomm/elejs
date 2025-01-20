<?php

use Asko\Js\Jsi;
use Asko\Js\Jsi\Traits\HasEventTarget;

(new Jsi)->alert(123);

$item = (new Jsi\Document)->querySelector(".selector");
$items = (new Jsi\Document)->querySelectorAll(".selector");

(new Jsi\Document)->querySelector("button")->addEventListener("click", function(Jsi\Event $e) {
    echo "test";
});
