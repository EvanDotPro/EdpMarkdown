<?php

namespace EdpMarkdown;

class Parser
{
    protected $engine;

    public function setEngine($engine)
    {
        $this->engine = $engine;
    }


    public function parse($string)
    {
        return $this->engine->transform($string);
    }
}