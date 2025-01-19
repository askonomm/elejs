<?php

namespace Asko\Js;

use PhpParser\Node;
use PhpParser\ParserFactory;
use PhpParser\PhpVersion;
use Crell;

class Js
{
    /**
     * @var Node\Stmt[]|null $ast
     */
    private ?array $ast;
    private string $phpVersion;
    private ?string $rootDir;
    private string $js = "";

    public function __construct(string $contents, string $phpVersion, ?string $rootDir = null) {
        $astParser = new ParserFactory()->createForVersion(PhpVersion::fromString($phpVersion));
        $this->phpVersion = $phpVersion;
        $this->ast = $astParser->parse($contents);
        $this->rootDir = $rootDir;

        if (!$this->ast) return;

        $this->traverseTree($this->ast);
    }

    public static function fromFile(string $path, string $version, ?string $rootDir = null): string
    {
        return new self(file_get_contents($path), $version, $rootDir)->toString();
    }

    public static function fromString(string $contents, string $version, ?string $rootDir = null): string
    {
        return new self($contents, $version, $rootDir)->toString();
    }

    private function traverseTree(?array $tree = []): void
    {
        foreach($tree as $node) {
            $this->js .= $this->parseNode($node) . "\n";
        }
    }

    private function parseExpression(Node\Stmt\Expression $node): string
    {
        return $this->parseNode($node->expr);
    }

    private function parseEcho(Node\Stmt\Echo_ $node): string
    {
        return Composer::print(array_map(fn($p) => $this->parseNode($p), $node->exprs));
    }

    private function parseFunction(Node\Stmt\Function_ $node): string
    {
        return Composer::function(
            name: $node->name->name,
            params: array_map(fn($x) => $this->parseNode($x), $node->params),
            contents: array_map(fn($p) => $this->parseNode($p), $node->stmts)
        );
    }

    private function parseReturn(Node\Stmt\Return_ $node): string
    {
        return Composer::return($this->parseNode($node->expr));
    }

    private function parseAssign(Node\Expr\Assign $node): string
    {
        return Composer::var($node->var->name, $this->parseNode($node->expr));
    }

    private function parseVariable(Node\Expr\Variable $node): string
    {
        return $node->name;
    }

    private function parseFunctionCall(Node\Expr\FuncCall $node): string
    {
        return Composer::functionCall(
            name: $node->name->name,
            args: array_map(fn($x) => $this->parseNode($x), $node->args)
        );
    }

    private function parseBinaryOp(Node\Expr\BinaryOp $node, string $op): string
    {
        $left = $this->parseNode($node->left);
        $right = $this->parseNode($node->right);

        return Composer::binaryOp($left, $right, $op);
    }

    private function parseString(Node\Scalar\String_ $node): string
    {
        return "\"$node->value\"";
    }

    private function parseParam(Node\Param $node): string
    {
        return $this->parseNode($node->var);
    }

    private function parseArg(Node\Arg $node): string
    {
        return $this->parseNode($node->value);
    }

    private function parseIf(Node\Stmt\If_ $node): string
    {
        return Composer::if(
            cond: $this->parseNode($node->cond),
            contents: array_map(fn($x) => $this->parseNode($x), $node->stmts)
        );
    }

    private function parseInclude(Node\Expr\Include_ $node): string
    {
        if (!$this->rootDir) return "";

        $path = match(get_class($node->expr)) {
            Node\Scalar\String_::class => $node->expr->value
        };

        return $this::fromFile(
            path: $this->rootDir . '/' . $path,
            version: $this->phpVersion
        );
    }

    private function parseNode(mixed $node): string
    {
        return match(get_class($node)) {
            Node\Stmt\Expression::class => $this->parseExpression($node),
            Node\Stmt\Echo_::class => $this->parseEcho($node),
            Node\Stmt\Function_::class => $this->parseFunction($node),
            Node\Stmt\Return_::class => $this->parseReturn($node),
            Node\Stmt\If_::class => $this->parseIf($node),
            Node\Expr\Include_::class => $this->parseInclude($node),
            Node\Expr\Assign::class => $this->parseAssign($node),
            Node\Expr\Variable::class => $this->parseVariable($node),
            Node\Expr\FuncCall::class => $this->parseFunctionCall($node),
            Node\Expr\BinaryOp\Plus::class => $this->parseBinaryOp($node, "+"),
            Node\Expr\BinaryOp\Minus::class => $this->parseBinaryOp($node, "-"),
            Node\Expr\BinaryOp\Identical::class => $this->parseBinaryOp($node, "==="),
            Node\Expr\BinaryOp\NotIdentical::class => $this->parseBinaryOp($node, "!=="),
            Node\Param::class => $this->parseParam($node),
            Node\Arg::class => $this->parseArg($node),
            Node\Scalar\String_::class => $this->parseString($node),
            Node\Scalar\Int_::class => $node->value,
            Node\Scalar\Float_::class => $node->value,
            default => "[" . get_class($node) . " not supported yet]\n"
        };
    }

    private function toString(): string
    {
        return $this->js;
    }
}
