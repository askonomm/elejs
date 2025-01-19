# Js

A library that transforms PHP code into JavaScript code, enabling you to write your front-end in your back-end.

**Note** that it merely transforms PHP into JavaScript, meaning that the behavior of code changes according to the differences 
between the PHP and JavaScript runtimes. 

## Installation

```shell
composer require asko/js
```

## Usage

```php
use Asko\Js\Js;

$js = Js::fromFile(path: 'some-php-file', version: '8.4');

// $js becomes a javascript string
```

Or:

```php
use Asko\Js\Js;

$js = Js::fromString(contents: '<?php echo "hello, world";', version: '8.4');

// $js becomes: console.log("hello, world");
```

If you also `include` other PHP files within your source PHP file / string, make sure to add the third 
parameter `rootDir` to where the root of those includes will be, so that you can then do relative path declarations. 
There is no support for `__DIR__` or the like just yet, so only relative paths work.

## Support

Most of the things are not yet supported. Only very basic PHP can currently be transpiled. You can check the 
[examples](https://github.com/askonomm/js/tree/master/examples) directory for what works.

### `Node/Expr`

- [ ] `AssignOp/BitwiseAnd`
- [ ] `AssignOp/BitwiseOr`
- [ ] `AssignOp/BitwiseXor`
- [ ] `AssignOp/Coalesce`
- [ ] `AssignOp/Concat`
- [ ] `AssignOp/Div`
- [ ] `AssignOp/Minus`
- [ ] `AssignOp/Mod`
- [ ] `AssignOp/Mul`
- [ ] `AssignOp/Plus`
- [ ] `AssignOp/Pow`
- [ ] `AssignOp/ShiftLeft`
- [ ] `AssignOp/ShiftRight`
- [ ] `BinaryOp/BitwiseAnd`
- [x] `BinaryOp/BitwiseOr`
- [ ] `BinaryOp/BitwiseXor`
- [ ] `BinaryOp/BooleanAnd`
- [x] `BinaryOp/BooleanOr`
- [ ] `BinaryOp/Coalesce`
- [ ] `BinaryOp/Concat`
- [ ] `BinaryOp/Div`
- [x] `BinaryOp/Equal`
- [ ] `BinaryOp/Greater`
- [ ] `BinaryOp/GreaterOrEqual`
- [x] `BinaryOp/Identical`
- [ ] `BinaryOp/LogicalAnd`
- [ ] `BinaryOp/LogicalOr`
- [ ] `BinaryOp/LogicalXor`
- [x] `BinaryOp/Minus`
- [x] `BinaryOp/Mod`
- [ ] `BinaryOp/Mul`
- [x] `BinaryOp/NotEqual`
- [x] `BinaryOp/NotIdentical`
- [x] `BinaryOp/Plus`
- [ ] `BinaryOp/Pow`
- [ ] `BinaryOp/ShiftLeft`
- [ ] `BinaryOp/ShiftRight`
- [ ] `BinaryOp/Smaller`
- [ ] `BinaryOp/SmallerOrEqual`
- [ ] `BinaryOp/Spaceship`
- [ ] `Cast/Array_`
- [ ] `Cast/Bool_`
- [ ] `Cast/Double`
- [ ] `Cast/Int_`
- [ ] `Cast/Object_`
- [ ] `Cast/String_`
- [ ] `Cast/Unset_`
- [ ] `Array_`
- [ ] `ArrayDimFetch`
- [ ] `ArrayItem`
- [ ] `ArrowFunction`
- [x] `Assign`
- [ ] `AssignOp`
- [ ] `AssignRef`
- [ ] `BinaryOp`
- [ ] `BitwiseNot`
- [x] `BooleanNot`
- [ ] `CallLike`
- [ ] `Cast`
- [ ] `ClassConstFetch`
- [ ] `Clone_`
- [ ] `Closure`
- [ ] `ClosureUse`
- [ ] `ConstFetch`
- [ ] `Empty_`
- [ ] `Error`
- [ ] `ErrorSuppress`
- [ ] `Eval_`
- [ ] `Exit_`
- [x] `FuncCall`
- [x] `Include_`
- [ ] `Instanceof_`
- [ ] `Isset_`
- [ ] `List_`
- [ ] `Match_`
- [ ] `MethodCall`
- [ ] `New_`
- [ ] `NullsafeMethodCall`
- [ ] `NullsafePropertyFetch`
- [ ] `PostDec`
- [ ] `PostInc`
- [ ] `PreDec`
- [ ] `PreInc`
- [ ] `Print_`
- [ ] `PropertyFetch`
- [ ] `ShellExec`
- [ ] `StaticCall`
- [ ] `StaticPropertyFetch`
- [ ] `Ternary`
- [ ] `Throw_`
- [ ] `UnaryMinus`
- [ ] `UnaryPlus`
- [x] `Variable`
- [ ] `Yield_`
- [ ] `YieldFrom`

### `Node/Scalar`

- [ ] `MagicConst/Class_`
- [ ] `MagicConst/Dir`
- [ ] `MagicConst/File`
- [ ] `MagicConst/Function_`
- [ ] `MagicConst/Line`
- [ ] `MagicConst/Method`
- [ ] `MagicConst/Namespace_`
- [ ] `MagicConst/Property`
- [ ] `MagicConst/Trait_`
- [ ] `DNumber`
- [ ] `Encapsed`
- [ ] `EncapsedStringPart`
- [x] `Float_`
- [x] `Int_`
- [ ] `InterpolatedString`
- [ ] `LNumber`
- [ ] `MagicConst`
- [x] `String_`

### `Node/Stmt`

- [ ] `Block`
- [ ] `Break_`
- [ ] `Case_`
- [ ] `Catch_`
- [ ] `Class_`
- [ ] `ClassConst`
- [ ] `ClassLike`
- [ ] `ClassMethod`
- [ ] `Const_`
- [ ] `Continue_`
- [ ] `Declare_`
- [ ] `DeclareDeclare`
- [ ] `Do_`
- [x] `Echo_`
- [ ] `Else_`
- [ ] `ElseIf_`
- [ ] `Enum_`
- [ ] `EnumCase`
- [x] `Expression`
- [ ] `Finally_`
- [ ] `For_`
- [ ] `Foreach_`
- [x] `Function_`
- [ ] `Global_`
- [ ] `Goto_`
- [ ] `GroupUse`
- [ ] `HaltCompiler`
- [x] `If_`
- [ ] `InlineHTML`
- [ ] `Interface_`
- [ ] `Label`
- [ ] `Namespace_`
- [ ] `Nop`
- [ ] `Property`
- [ ] `PropertyProperty`
- [x] `Return_`
- [ ] `Static_`
- [ ] `StaticVar`
- [ ] `Switch_`
- [ ] `Trait_`
- [ ] `TraitUse`
- [ ] `TraitUseAdaptation`
- [ ] `TryCatch`
- [ ] `Unset_`
- [ ] `Use_`
- [ ] `UseUse`
- [ ] `While_`

### `Node/`

- [x] `Arg`
- [ ] `ArrayItem`
- [ ] `Attribute`
- [ ] `AttributeGroup`
- [ ] `ClosureUse`
- [ ] `ComplexType`
- [ ] `Const_`
- [ ] `DeclareItem`
- [ ] `Expr`
- [ ] `FunctionLike`
- [ ] `Identifier`
- [ ] `InterpolatedStringPart`
- [ ] `IntersectionType`
- [ ] `MatchArm`
- [ ] `Name`
- [ ] `NullableType`
- [x] `Param`
- [ ] `PropertyHook`
- [ ] `PropertyItem`
- [ ] `Scalar`
- [ ] `StaticVar`
- [ ] `Stmt`
- [ ] `UnionType`
- [ ] `UseItem`
- [ ] `VarLikeIdentifier`
- [ ] `VariadicPlaceholder`