# EleJs

A library that transforms PHP code into JavaScript code, enabling you to write your front-end in your back-end.

**Note** that it merely transforms PHP into JavaScript, meaning that the behavior of code changes according to the differences 
between the PHP and JavaScript runtimes. A lot of (most of) stuff is missing, especially when it comes to JS interop definitions. 
That said, a proof of concept is working, and demonstrates that it is indeed possible to transpile PHP into JavaScript. 

## Installation

```shell
composer require asko/elejs
```

## Usage

```php
use Asko\Js\Js;

$js = Js::fromFile('some-php-file.php');
```

Or:

```php
use Asko\Js\Js;

$js = Js::fromString('<?php echo "hello, world";');

// $js becomes: console.log("hello, world");
```

If you also `include` other PHP files within your source PHP file / string, make sure to add the third
parameter `rootDir` to where the root of those includes will be, so that you can then do relative path declarations.
There is no support for `__DIR__` or the like just yet, so only relative paths work.

### JavaScript Interop 

You can also call JS API's from your PHP, like so:

```php
use Asko\Js\Jsi;

function my_func(): void {
    Jsi::alert("Alert about something");
}
```

Which would become the following JavaScript:

```javascript
function my_func() {
    alert("Alert about something");
}
```

## Support

To see the current status of things check out:

- [PHP support](https://github.com/askonomm/js/blob/master/docs/support/php.md)
- [JS Interop Support](https://github.com/askonomm/js/blob/master/docs/support/js-interop.md)
