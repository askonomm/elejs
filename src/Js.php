<?php

namespace Asko\Js;

use PhpParser\Node\ArrayItem;
use PhpParser\Node\Const_;
use PhpParser\Node\Stmt;
use PhpParser\Node\Expr;
use PhpParser\Node\Scalar;
use PhpParser\Node\Param;
use PhpParser\Node\Arg;
use PhpParser\ParserFactory;
use PhpParser\PhpVersion;
use Crell;

class Js
{
    /**
     * @var Stmt[]|null $ast
     */
    private ?array $ast;
    private string $phpVersion;
    private ?string $rootDir;
    private string $js = "";

    public function __construct(string $contents, string $phpVersion, ?string $rootDir = null)
    {
        $astParser = new ParserFactory()->createForVersion(PhpVersion::fromString($phpVersion));
        $this->phpVersion = $phpVersion;
        $this->ast = $astParser->parse($contents);
        $this->rootDir = $rootDir;

        if (!$this->ast) return;

        $this->traverseTree($this->ast);
    }

    public static function fromFile(string $path, string $version = '8.4', ?string $rootDir = null): string
    {
        return new self(file_get_contents($path), $version, $rootDir)->toString();
    }

    public static function fromString(string $contents, string $version = '8.4', ?string $rootDir = null): string
    {
        return new self($contents, $version, $rootDir)->toString();
    }

    private function traverseTree(?array $tree = []): void
    {
        foreach ($tree as $node) {
            $this->js .= $this->parseNode($node) . "\n";
        }
    }

    private function parseExpressionStmt(Stmt\Expression $node): string
    {
        return $this->parseNode($node->expr) . ";";
    }

    private function parseEchoStmt(Stmt\Echo_ $node): string
    {
        return Composer::print(array_map(fn($p) => $this->parseNode($p), $node->exprs)) . ";";
    }

    private function parseFunctionStmt(Stmt\Function_ $node): string
    {
        return Composer::function(
            name: $node->name->name,
            params: array_map(fn($x) => $this->parseNode($x), $node->params),
            contents: array_map(fn($p) => $this->parseNode($p), $node->stmts)
        );
    }

    private function parseReturnStmt(Stmt\Return_ $node): string
    {
        return Composer::return($this->parseNode($node->expr)) . ";";
    }

    private function parseAssign(Expr\Assign $node): string
    {
        return Composer::var($node->var->name, $this->parseNode($node->expr));
    }

    private function parseVariable(Expr\Variable $node): string
    {
        return $node->name;
    }

    private function parseFunctionCall(Expr\FuncCall $node): string
    {
        return Composer::functionCall(
            name: $node->name->name,
            args: array_map(fn($x) => $this->parseNode($x), $node->args)
        );
    }

    private function parseBinaryOp(Expr\BinaryOp $node, string $op): string
    {
        $left = $this->parseNode($node->left);
        $right = $this->parseNode($node->right);

        return Composer::binaryOp($left, $right, $op);
    }

    private function parseString(Scalar\String_ $node): string
    {
        return "\"$node->value\"";
    }

    private function parseParam(Param $node): string
    {
        return $this->parseNode($node->var);
    }

    private function parseArg(Arg $node): string
    {
        return $this->parseNode($node->value);
    }

    private function parseIfStmt(Stmt\If_ $node): string
    {
        return Composer::if(
            cond: $this->parseNode($node->cond),
            contents: array_map(fn($x) => $this->parseNode($x), $node->stmts)
        );
    }

    private function parseInclude(Expr\Include_ $node): string
    {
        if (!$this->rootDir) return "";

        $path = match (get_class($node->expr)) {
            Scalar\String_::class => $node->expr->value
        };

        return $this::fromFile(
            path: $this->rootDir . '/' . $path,
            version: $this->phpVersion
        );
    }

    private function parseBooleanNot(Expr\BooleanNot $node): string
    {
        return Composer::booleanNot($this->parseNode($node->expr));
    }

    private function parseBitwiseNot(Expr\BitwiseNot $node): string
    {
        return Composer::bitwiseNot($this->parseNode($node->expr));
    }

    private function parseTernary(Expr\Ternary $node): string
    {
        $cond = $this->parseNode($node->cond);
        $if = $node->if ? $this->parseNode($node->if) : null;
        $else = $this->parseNode($node->else);

        return Composer::ternary($cond, $if, $else);
    }

    private function parseAssignOp(Expr\AssignOp $node, string $op): string
    {
        return Composer::assignOp(
            var: $this->parseNode($node->var),
            op: $op,
            value: $this->parseNode($node->expr)
        );
    }

    private function parsePostInc(Expr\PostInc $node): string
    {
        return Composer::postInc($this->parseNode($node->var));
    }

    private function parsePostDec(Expr\PostDec $node): string
    {
        return Composer::postDec($this->parseNode($node->var));
    }

    private function parseConstStmt(Stmt\Const_ $node): string
    {
        $consts = [];

        if (isset($node->consts)) {
            foreach ($node->consts as $const) {
                $consts[] = $this->parseNode($const);
            }
        }

        return implode("\n", $consts) . ";";
    }

    private function parseConst(Const_ $node): string
    {
        return Composer::const($node->name, $this->parseNode($node->value));
    }

    private function parseArray(Expr\Array_ $node): string
    {
        $noKeys = array_all($node->items, fn(ArrayItem $x) => $x->key === null);

        if ($noKeys) {
            return Composer::array(array_map(fn($x) => $this->parseNode($x), $node->items));
        }

        return Composer::object(array_map(fn($x) => $this->parseNode($x), $node->items));
    }

    private function parseArrayItem(ArrayItem $node): string
    {
        if (!$node->key) {
            return $this->parseNode($node->value);
        }

        return "{$this->parseNode($node->key)}: {$this->parseNode($node->value)}";
    }

    private function parseNode(mixed $node): string
    {
        return match (get_class($node)) {
            Stmt\Expression::class => $this->parseExpressionStmt($node),
            Stmt\Echo_::class => $this->parseEchoStmt($node),
            Stmt\Function_::class => $this->parseFunctionStmt($node),
            Stmt\Return_::class => $this->parseReturnStmt($node),
            Stmt\If_::class => $this->parseIfStmt($node),
            Stmt\Const_::class => $this->parseConstStmt($node),
            Expr\Array_::class => $this->parseArray($node),
            Expr\Include_::class => $this->parseInclude($node),
            Expr\Assign::class => $this->parseAssign($node),
            Expr\BitwiseNot::class => $this->parseBitwiseNot($node),
            Expr\BooleanNot::class => $this->parseBooleanNot($node),
            Expr\Variable::class => $this->parseVariable($node),
            Expr\FuncCall::class => $this->parseFunctionCall($node),
            Expr\Ternary::class => $this->parseTernary($node),
            Expr\PostInc::class => $this->parsePostInc($node),
            Expr\PostDec::class => $this->parsePostDec($node),
            Expr\AssignOp\Concat::class, Expr\AssignOp\Plus::class => $this->parseAssignOp($node, "+="),
            Expr\AssignOp\Minus::class => $this->parseAssignOp($node, "-="),
            Expr\AssignOp\Mul::class => $this->parseAssignOp($node, "*="),
            Expr\AssignOp\BitwiseXor::class => $this->parseAssignOp($node, "^="),
            Expr\AssignOp\BitwiseOr::class => $this->parseAssignOp($node, "|="),
            Expr\AssignOp\BitwiseAnd::class => $this->parseAssignOp($node, "&="),
            Expr\AssignOp\ShiftLeft::class => $this->parseAssignOp($node, "<<="),
            Expr\AssignOp\ShiftRight::class => $this->parseAssignOp($node, ">>="),
            Expr\AssignOp\Div::class => $this->parseAssignOp($node, "/="),
            Expr\AssignOp\Mod::class => $this->parseAssignOp($node, "%="),
            Expr\AssignOp\Pow::class => $this->parseAssignOp($node, "**="),
            Expr\AssignOp\Coalesce::class => $this->parseAssignOp($node, "??="),
            Expr\BinaryOp\BitwiseAnd::class => $this->parseBinaryOp($node, "&"),
            Expr\BinaryOp\BitwiseOr::class => $this->parseBinaryOp($node, "|"),
            Expr\BinaryOp\BitwiseXor::class, Expr\BinaryOp\LogicalXor::class => $this->parseBinaryOp($node, "^"),
            Expr\BinaryOp\BooleanAnd::class, Expr\BinaryOp\LogicalAnd::class => $this->parseBinaryOp($node, "&&"),
            Expr\BinaryOp\BooleanOr::class, Expr\BinaryOp\LogicalOr::class => $this->parseBinaryOp($node, "||"),
            Expr\BinaryOp\Plus::class, Expr\BinaryOp\Concat::class => $this->parseBinaryOp($node, "+"),
            Expr\BinaryOp\Minus::class => $this->parseBinaryOp($node, "-"),
            Expr\BinaryOp\Identical::class => $this->parseBinaryOp($node, "==="),
            Expr\BinaryOp\NotIdentical::class => $this->parseBinaryOp($node, "!=="),
            Expr\BinaryOp\Mod::class => $this->parseBinaryOp($node, "%"),
            Expr\BinaryOp\Equal::class => $this->parseBinaryOp($node, "=="),
            Expr\BinaryOp\NotEqual::class => $this->parseBinaryOp($node, "!="),
            Expr\BinaryOp\ShiftLeft::class => $this->parseBinaryOp($node, "<<"),
            Expr\BinaryOp\ShiftRight::class => $this->parseBinaryOp($node, ">>"),
            Expr\BinaryOp\Div::class => $this->parseBinaryOp($node, "/"),
            Expr\BinaryOp\Greater::class => $this->parseBinaryOp($node, ">"),
            Expr\BinaryOp\GreaterOrEqual::class => $this->parseBinaryOp($node, ">="),
            Expr\BinaryOp\Smaller::class => $this->parseBinaryOp($node, "<"),
            Expr\BinaryOp\SmallerOrEqual::class => $this->parseBinaryOp($node, "<="),
            Expr\BinaryOp\Spaceship::class => $this->parseBinaryOp($node, "<=>"),
            Expr\BinaryOp\Mul::class => $this->parseBinaryOp($node, "*"),
            Expr\BinaryOp\Coalesce::class => $this->parseBinaryOp($node, "??"),
            Expr\BinaryOp\Pow::class => $this->parseBinaryOp($node, "**"),
            Scalar\String_::class => $this->parseString($node),
            Scalar\Int_::class => $node->value,
            Scalar\Float_::class => $node->value,
            Param::class => $this->parseParam($node),
            Arg::class => $this->parseArg($node),
            ArrayItem::class => $this->parseArrayItem($node),
            Const_::class => $this->parseConst($node),
            default => "[" . get_class($node) . " not supported yet]"
        };
    }

    private function toString(): string
    {
        return $this->js;
    }
}
