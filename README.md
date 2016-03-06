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
<?php echo $this->markdown('Hello, **this** is _Markdown_!'); ?>
```

You may also use MarkdownExtra with this module:

```php
<?php echo $this->markdown('Hello, **this** is <strong>MarkdownExtra</strong>!', \EdpMarkdown\Module::MARKDOWN_EXTRA); ?>
```

or simpler:

```php
<?php echo $this->markdown('Hello, **this** is <strong>MarkdownExtra</strong>!', 'extra'); ?>
```

If you want all your calls to the markdown-helper to use MarkdownExtra, you can setup the default Markdown-type as follows:

```php
// For example in your onBootsrap-method:
\EdpMarkdown\Module::setDefaultType(\EdpMarkdown\Module::MARKDOWN_EXTRA);
```

**NOTE:** For security purposes, the output **SHOULD** be [sanitized](http://htmlpurifier.org/) if the Markdown is from an untrusted source. ([@padraic](https://github.com/padraic) says so!) See the [Markdown documentation on inline HTML](http://daringfireball.net/projects/markdown/syntax#html) to understand why this is necessary.

## License

EdpMarkdown is released under the New BSD license. See the included LICENSE file.

PHP Markdown is available under the New BSD or the GNU GPL v2.
