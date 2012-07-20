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
        require_once __DIR__ . '/php-markdown/markdown.php';
        return Markdown($string);
    }
}
