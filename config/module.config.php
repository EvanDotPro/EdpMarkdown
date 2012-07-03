<?php
return array(
    'di' => array(
        'instance' => array(
            'alias' => array(
                'edpmarkdown_parser' => 'MarkdownExtra_Parser',
                //'edpmarkdown_parser' => 'Markdown_Parser',
            ),
            'Zend\View\HelperLoader' => array(
                'parameters' => array(
                    'map' => array(
                        'markdown' => 'EdpMarkdown\View\Helper\Markdown',
                    ),
                ),
            ),
            'Zend\View\PhpRenderer' => array(
                'parameters' => array(
                    'broker' => 'Zend\View\HelperBroker',
                ),
            ),
            'Zend\View\HelperBroker' => array(
                'parameters' => array(
                    'loader' => 'Zend\View\HelperLoader',
                ),
            ),
            'EdpMarkdown\Parser' => array(
                'parameters' => array(
                    'engine' => 'edpmarkdown_parser',
                ),
            ),
            'EdpMarkdown\View\Helper\Markdown' => array(
                'parameters' => array(
                    'parser' => 'EdpMarkdown\Parser',
                ),
            ),
        ),
    ),
);
