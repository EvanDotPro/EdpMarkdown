<?php
namespace EdpMarkdown\View\Helper;

use EdpMarkdown\Parser;

use Zend\View\Helper\AbstractHelper;

class Markdown extends AbstractHelper
{
    /**
     * @var Parser
     */
    protected $parser;

    public function __construct()
    {
    }

    /**
     * @param Parser $parser
     */
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

        return $this->parser->parse($string);
    }

    public function start()
    {
        ob_start();
    }

    public function end()
    {
        echo $this->parser->parse(ob_get_clean());
    }
}
