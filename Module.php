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
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
