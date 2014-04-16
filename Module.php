<?php
namespace EdpMarkdown;

class Module extends \Zend\View\Helper\AbstractHelper
{
    public function getViewHelperConfig()
    {
        return array('services' => array('markdown' => $this));
    }

    public function __invoke($string = null)
    {
        if (!class_exists('Michelf\Markdown')) require_once __DIR__ . '/vendor/php-markdown/Michelf/Markdown.inc.php';
        return \Michelf\Markdown::defaultTransform($string);
    }
}
