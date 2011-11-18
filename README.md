EdpMarkdown - ZF2 Markdown Module
=================================
Version 0.0.1 Created by [Evan Coury](http://blog.evan.pro/)

Introduction
------------
This ZF2 module simply adds [markdown](http://daringfireball.net/projects/markdown/) support to your project. It utilizes the [PHP Markdown](http://michelf.com/projects/php-markdown/) library written by [Michel Fortin](http://michelf.com/) which is a PHP port of the original perl implementation by [John Gruber](http://daringfireball.net/). 

Installation
------------
To install EdpMarkdown, simply clone this repository into your modules directory
and enable it in your `configs/application.config.php` file. That's it!

Usage
-----
With this module installed, using markdown in your view scripts is easy:

    <?php $this->markdown()->start(); ?>
    Hello, **this** is _markdown_!
    <?php $this->markdown()->end(); ?>

or...

    <?= $this->markdown('Hello, **this** is _markdown_!'); ?>

Configuration
-------------
By default, this module uses the ["Markdown Extra"](http://michelf.com/projects/php-markdown/extra/) parser. If you'd like to switch it to just use the normal markdown parser, you can add the following DI alias to your config:

    'markdown-parser' => 'Markdown_Parser'
