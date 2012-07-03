<?php

namespace EdpMarkdown;

use Zend\EventManager\Event as ZendEvent;

class Event extends ZendEvent
{
    public function getResult()
    {
        return $this->getParam('__RESULT__');
    }

    public function setResult($result)
    {
        $this->setParam('__RESULT__', $result);
        return $this;
    }

    public function getSource()
    {
        return $this->getParam('__SOURCE__');
    }

    public function setSource($result)
    {
        $this->setParam('__SOURCE__', $result);
        return $this;
    }
}