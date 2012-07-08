<?php

namespace EdpMarkdown;

use EdpMarkdown\View\Helper\Markdown as MarkdownHelper;

class Module
{
    public function getViewHelperConfiguration()
    {
        return array(
            'factories' => array(
                'markdown' => function($helperPluginManager) {
                    $serviceManager = $helperPluginManager->getServiceLocator();
                    $markdownParser = $serviceManager->get('edpmarkdown_parser');
                    return new MarkdownHelper($markdownParser);
                }
            ),
        );
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                array(
                    'EdpMarkdown\View\Helper\Markdown' => __DIR__ . '/src/EdpMarkdown/View/Helper/Markdown.php',
                    'Textile'                          => __DIR__ . '/src/PhpMarkdown/markdown.php',
                    'Markdown_Parser'                  => __DIR__ . '/src/PhpMarkdown/markdown.php',
                    'MarkdownExtra_Parser'             => __DIR__ . '/src/PhpMarkdown/markdown.php',
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
}
