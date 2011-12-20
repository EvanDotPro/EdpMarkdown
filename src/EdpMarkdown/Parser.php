<?php

namespace EdpMarkdown;

use Zend\EventManager\EventCollection,
    Zend\EventManager\EventManager,
    Zend\EventManager\Event;

class Parser
{
    /**
     * @var Markdown_Parser
     */
    protected $engine;

    /**
     * @var Event
     */
    protected $event;

    /**
     * @var EventManager
     */
    protected $events;

    public function setEngine($engine)
    {
        $this->engine = $engine;
    }

    /**
     * Set the event manager instance used by this module manager.
     *
     * @param EventCollection $events
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
     * @return Event
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

    /**
     * Parse Markdown string.
     *
     * This function triggers events to allow applying some filters.
     *
     * @param $string
     * @return mixed
     * @triggers parse.pre
     * @triggers parse.post
     */
    public function parse($string)
    {
        $event = $this->getEvent();
        $event->setParam('__RESULT__', $string);

        $this->events()->trigger(__FUNCTION__ . '.pre', $this, $event, function ($response) use ($event) {
            // set returned value as __RESULT__ param, so that it can be processed by next filter
            $event->setParam('__RESULT__', $response);
        });

        // do the transformation
        $event->setParam('__RESULT__', $this->engine->transform($event->getParam('__RESULT__')));

        $this->events()->trigger(__FUNCTION__ . '.post', $this, $this->getEvent(), function ($response) use ($event) {
            // set returned value as __RESULT__ param, so that it can be processed by next filter
            $event->setParam('__RESULT__', $response);
        });

        return $event->getParam('__RESULT__');
    }
}