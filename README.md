EdpMarkdown - ZF2 Markdown Module
=================================
Version 0.0.1 Created by [Evan Coury](http://blog.evan.pro/)

**NOTE: THIS CURRENTLY DEPENDS ON A PATCH TO THE PLUGINBROKER THAT IS NOT MERGED
INTO THE ZF2 MASTER. An alternative Service Locator strategy is being developed
to replace the PluginBroker stuff in ZF2, so development of this module is
currently on hold. You can still use this module, but it will require you
manually inject the Markdown renderer into the view helper yourself somehow. See
the DI configuration in this module for an idea of how this works.**

Introduction
------------
This ZF2 module simply adds [markdown](http://daringfireball.net/projects/markdown/) support to your project. It utilizes the [PHP Markdown](http://michelf.com/projects/php-markdown/) library written by [Michel Fortin](http://michelf.com/) which is a PHP port of the original perl implementation by [John Gruber](http://daringfireball.net/). 

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
