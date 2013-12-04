<?php
namespace EdpMarkdown;


use Michelf\Markdown;

class Module extends \Zend\View\Helper\AbstractHelper
{

    public function getViewHelperConfig()
    {
        return array('services' => array('markdown' => $this));
    }

    public function __invoke($string = null)
    {
        if (file_exists(__DIR__.'/../../autoload.php')) {
            return Markdown::defaultTransform($string);
        }
        require_once __DIR__ . '/php-markdown/markdown.php';
        return Markdown($string);
    }
}
