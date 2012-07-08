<?php

namespace EdpMarkdown;

use Zend\View\Helper\AbstractHelper;

class Module extends AbstractHelper
{
    public function getViewHelperConfiguration()
    {
        $self = $this;
        return array(
            'factories' => array(
                'markdown' => function($helperPluginManager) use ($self) {
                    $serviceManager = $helperPluginManager->getServiceLocator();
                    return $self->setParser($serviceManager->get('edpmarkdown_parser'));
                }
            ),
        );
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                array(
                    'Textile'              => __DIR__ . '/src/PhpMarkdown/markdown.php',
                    'Markdown_Parser'      => __DIR__ . '/src/PhpMarkdown/markdown.php',
                    'MarkdownExtra_Parser' => __DIR__ . '/src/PhpMarkdown/markdown.php',
                ),
            ),
        );
    }

    public function getConfig()
    {
        return array(
            'service_manager' => array(
                'invokables' => array(
                    'edpmarkdown_parser' => 'MarkdownExtra_Parser',
                ),
            ),
        );
    }

    /**
     * View helper stuff
     */
    public function setParser($parser)
    {
        $this->parser = $parser;
        return $this;
    }

    public function __invoke($string = null)
    {
        if (null === $this->parser) {
            return $string;
        }
        if ($string === null) {
            return $this;
        }

        return $this->parser->transform($string);
    }

    public function start()
    {
        ob_start();
    }

    public function end()
    {
        echo $this->parser->transform(ob_get_clean());
    }
}
