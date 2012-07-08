<?php

namespace EdpMarkdown;

use Zend\EventManager\EventManager;
use Zend\EventManager\SharedEventManager;
use Zend\Mvc\MvcEvent;
use Zend\View\Helper\AbstractHelper;


class Module extends AbstractHelper
{

    /**
     * @var SharedEventManager
     */
    protected $sharedManager;

    /**
     * @var EventManager
     */
    protected $eventManager;

    public function getViewHelperConfiguration()
    {
        $self = $this;
        return array(
            'factories' => array(
                'markdown' => function($helperPluginManager) use ($self) {
                    $serviceManager = $helperPluginManager->getServiceLocator();
                    return $self->setParser($serviceManager->get('edpmarkdown_parser'));
                }
            ),
        );
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                array(
                    'EdpMarkdown\Event'    => __DIR__ . '/src/EdpMarkdown/Event.php',
                    'Textile'              => __DIR__ . '/src/PhpMarkdown/markdown.php',
                    'Markdown_Parser'      => __DIR__ . '/src/PhpMarkdown/markdown.php',
                    'MarkdownExtra_Parser' => __DIR__ . '/src/PhpMarkdown/markdown.php',
                ),
            ),
        );
    }

    public function getConfig()
    {
        return array(
            'service_manager' => array(
                'invokables' => array(
                    'edpmarkdown_parser' => 'MarkdownExtra_Parser',
                ),
            ),
        );
    }

    /**
     * Module bootstrap - used to obtain EventManager instance
     *
     * @param MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e)
    {
        $this->setSharedManager($e->getApplication()->getEventManager()->getSharedManager());
    }

    /**
     * View helper stuff
     */
    public function setParser($parser)
    {
        $this->parser = $parser;
        return $this;
    }

    /**
     * Parse markdown string and trigger events.
     *
     * @param $string
     * @return mixed
     */
    public function parse($string)
    {
        $eventManager = $this->getEventManager();

        $event = new Event();
        $event->setSource($string);

        // trigger parse.pre
        $eventManager->trigger(__FUNCTION__ . '.pre', $this, $event);

        // do the transformation
        $event->setResult($this->parser->transform($event->getSource()));

        // trigger parse.post
        $eventManager->trigger(__FUNCTION__ . '.post', $this, $event);

        return $event->getResult();
    }

    public function __invoke($string = null)
    {
        if (null === $this->parser) {
            return $string;
        }
        if (null === $string) {
            return $this;
        }

        return $this->parse($string);
    }

    public function start()
    {
        ob_start();
    }

    public function end()
    {
        echo $this->parse(ob_get_clean());
    }

    /**
     * @param SharedEventManager $eventManager
     * @return Module provides fluent interface
     */
    public function setSharedManager($eventManager)
    {
        $this->sharedManager = $eventManager;
        return $this;
    }

    /**
     * @return SharedEventManager
     */
    public function getSharedManager()
    {
        return $this->sharedManager;
    }

    /**
     * @param EventManager $eventManager
     * @return Module provides fluent interface
     */
    public function setEventManager($eventManager)
    {
        $this->eventManager = $eventManager;
        return $this;
    }

    /**
     * @return EventManager
     */
    public function getEventManager()
    {
        if (null === $this->eventManager) {
            $this->eventManager = new EventManager(array(
                __CLASS__,
                get_called_class(),
            ));
            $this->eventManager->setSharedManager($this->getSharedManager());
        }
        return $this->eventManager;
    }
}
