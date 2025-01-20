<?php

namespace Asko\Js;

class Composer
{
    public static function print(array $vars): string
    {
        $varsStr = implode(' + ', $vars);

        return "console.log($varsStr)";
    }

    public static function var(string $name, mixed $value): string
    {
        return "let {$name} = {$value}";
    }

    public static function propertyVar(string $name, mixed $value): string
    {
        return "{$name} = {$value}";
    }

    public static function const(string $name, mixed $value): string
    {
        return "const {$name} = {$value}";
    }

    public static function function(string $name, array $params, array $stmts): string
    {
        $_js = "function {$name}(" . implode(', ', $params) . ") {\n";

        foreach ($stmts as $stmt) {
            $_js .= $stmt . "\n";
        }

        $_js .= "}";

        return $_js;
    }

    public static function return(mixed $var): string
    {
        return "return {$var}";
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

    public static function assignOp(string $var, string $op, mixed $value): string
    {
        return "{$var} {$op} {$value}";
    }

    public static function bitwiseNot(string $value): string
    {
        return "~{$value}";
    }

    public static function booleanNot(string $value): string
    {
        return "!{$value}";
    }

    public static function if(string $cond, array $stmts): string
    {
        $_js = "if ({$cond}) {\n";

        foreach ($stmts as $stmt) {
            $_js .= $stmt . "\n";
        }

        $_js .= "}";

        return $_js;
    }

    public static function ternary(string $cond, string | null $if, string $else): string
    {
        if (is_null($if)) {
            return "{$cond} || {$else}";
        }

        return "{$cond} ? {$if} : {$else}";
    }

    public static function postInc(string $var): string
    {
        return "{$var}++";
    }

    public static function postDec(string $var): string
    {
        return "{$var}--";
    }

    public static function array(array $items): string
    {
        return "[" . implode(', ', $items) . "]";
    }

    public static function object(array $items): string
    {
        return "{" . implode(', ', $items) . "}";
    }

    public static function class(string $name, array $stmts): string
    {
        $_js = "class {$name} {\n";

        foreach ($stmts as $stmt) {
            $_js .= $stmt . "\n";
        }

        $_js .= "}";

        return $_js;
    }

    public static function classMethod(string $name, array $params, array $stmts): string
    {
        $_js = "{$name}(" . implode(', ', $params) . ") {\n";

        foreach ($stmts as $stmt) {
            $_js .= $stmt . "\n";
        }

        $_js .= "}";

        return $_js;
    }

    public static function property(string $name, mixed $default): string
    {
        if (!$default) {
            return "{$name}";
        }

        return "{$name} = {$default}";
    }
}