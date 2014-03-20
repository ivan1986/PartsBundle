<?php

namespace Ivan1986\PartsBundle\Routing;

use Ivan1986\PartsBundle\Event\RouteEvent;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\RouteCollection;

class EventRouteLoader extends Loader {

    /** @var EventDispatcherInterface */
    private $events;

    public function __construct(EventDispatcherInterface $events)
    {
        $this->events = $events;
    }

    public function load($resource, $type = null)
    {
        $event = new RouteEvent($this);
        $this->events->dispatch('route.load', $event);
        return $event->getCollection();
    }

    public function supports($resource, $type = null)
    {
        return $type === 'event';
    }

}