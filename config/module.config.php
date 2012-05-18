<?php
return array(
    'di' => array(
        'instance' => array(
            'alias' => array(
                'edpmarkdown_parser' => 'MarkdownExtra_Parser',
                //'edpmarkdown_parser' => 'Markdown_Parser',
            ),
            'EdpMarkdown\View\Helper\Markdown' => array(
                'parameters' => array(
                    'parser' => 'edpmarkdown_parser',
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'helper_map' => array(
            'markdown' => 'EdpMarkdown\View\Helper\Markdown',
        ),
    ),
);
