# EdpMarkdown - ZF2 Markdown Module

Version 0.0.1 Created by [Evan Coury](http://blog.evan.pro/)

## Introduction

This ZF2 module simply adds [Markdown](http://daringfireball.net/projects/markdown/) support to your project. It utilizes the [PHP Markdown](http://michelf.com/projects/php-markdown/) library written by [Michel Fortin](http://michelf.com/) which is a PHP port of the original perl implementation by [John Gruber](http://daringfireball.net/).

## Installation

To install EdpMarkdown, simply recursively clone this repository (`git clone
--recursive`) into your ZF2 modules directory and enable it in your
`config/application.config.php` file.  That's it!

## Usage

With this module installed, using Markdown in your view scripts is easy:

```php
<?= $this->markdown('Hello, **this** is _Markdown_!'); ?>
```

**NOTE:** For security purposes, the output **SHOULD** be [sanitized](http://htmlpurifier.org/) if the Markdown is from an untrusted source. ([@padraic](https://github.com/padraic) says so!) See the [Markdown documentation on inline HTML](http://daringfireball.net/projects/markdown/syntax#html) to understand why this is necessary.

## Configuration

By default, this module uses the ["Markdown Extra"](http://michelf.com/projects/php-markdown/extra/)
parser. If you'd like to switch it to just use the normal markdown parser, you
can simply define the `MARKDOWN_PARSER_CLASS`, which PHP Markdown is configured
to check for. An easy place to do this would be in a config file such as
`./config/autoload/global.php`.

```php
<?php
define('MARKDOWN_PARSER_CLASS',  'Markdown_Parser');
```

## License

EdpMarkdown is released under the New BSD license. See the included LICENSE file.

PHP Markdown is available under the New BSD or the GNU GPL v2.
