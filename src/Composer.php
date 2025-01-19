<?php

namespace Asko\Js;

class Composer
{
    public static function print(array $vars): string
    {
        $varsStr = implode(' + ', $vars);

        return "console.log($varsStr);";
    }

    public static function var(string $name, mixed $value): string
    {
        return "let $name = {$value};";
    }

    public static function function(string $name, array $params, array $contents): string
    {
        $_js = "function {$name}(" . implode(', ', $params) . ") {\n";

        foreach ($contents as $content) {
            $_js .= $content . "\n";
        }

        $_js .= "\n}";

        return $_js;
    }

    public static function return(mixed $var): string
    {
        return "return {$var};";
    }

    public static function functionCall(string $name, array $args): string
    {
        return "{$name}(" . implode(', ', $args) . ")";
    }

    public static function binaryOp(mixed $left, mixed $right, string $op): string
    {
        if ($op === "<=>") {
            return "Math.sign({$left} - {$right})";
        }

        return "{$left} {$op} {$right}";
    }

    public static function bitwiseNot(string $value): string
    {
        return "~{$value}";
    }

    public static function booleanNot(string $value): string
    {
        return "!{$value}";
    }

    public static function if(string $cond, array $contents): string
    {
        $_js = "if ({$cond}) {\n";

        foreach ($contents as $content) {
            $_js .= $content . "\n";
        }

        $_js .= "\n}";

        return $_js;
    }
}