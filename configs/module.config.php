<?php
return array(
    'di' => array(
        'instance' => array(
            'alias' => array(
                'markdown-parser' => 'MarkdownExtra_Parser',
                //'markdown-parser' => 'Markdown_Parser',
            ),
            'Zend\View\HelperLoader' => array(
                'parameters' => array(
                    'map' => array(
                        'markdown' => 'EdpMarkdown\View\Helper\Markdown',
                    ),
                ),
            ),
            'EdpMarkdown\View\Helper\Markdown' => array(
                'parameters' => array(
                    'parser' => 'markdown-parser',
                ),
            ),
        ),
    ),
);
