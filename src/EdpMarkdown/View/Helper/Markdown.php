<?php
namespace EdpMarkdown\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Markdown extends AbstractHelper
{
    protected $parser;

    public function __construct()
    {
    }

    public function setParser($parser)
    {
        $this->parser = $parser;
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
