<?php

namespace EdpMarkdown;

use Zend\EventManager\EventCollection,
    Zend\EventManager\EventManager,
    Zend\EventManager\Event;

class Parser
{
    protected $engine;

    protected $event;

    protected $events;

    public function setEngine($engine)
    {
        $this->engine = $engine;
    }

    /**
     * Set the event manager instance used by this module manager.
     *
     * @param  EventCollection $events
     * @return Manager
     */
    public function setEventManager(EventCollection $events)
    {
        $this->events = $events;
        return $this;
    }
    /**
     * Retrieve the event manager
     *
     * Lazy-loads an EventManager instance if none registered.
     *
     * @return EventCollection
     */
    public function events()
    {
        if (!$this->events instanceof EventCollection) {
            $this->setEventManager(new EventManager(array(__CLASS__, get_class($this))));
        }
        return $this->events;
    }

    /**
     * Get the module event
     *
     * @return \Zend\EventManager\Event
     */
    public function getEvent()
    {
        if (!$this->event instanceof Event) {
            $this->setEvent(new Event);
        }
        return $this->event;
    }

    /**
     * Set the module event
     *
     * @param Event $event
     * @return Parser
     */
    public function setEvent(Event $event)
    {
        $this->event = $event;
        return $this;
    }

    public function parse($string)
    {
        $event = $this->getEvent();

        $event->setParam('string', $string);

        $this->events()->trigger(__FUNCTION__ . '.pre', $this, $event);
        $event->setParam('string', $this->engine->transform($event->getParam('string')));
        $this->events()->trigger(__FUNCTION__ . '.post', $this, $this->getEvent());
        return $event->getParam('string');
    }
}