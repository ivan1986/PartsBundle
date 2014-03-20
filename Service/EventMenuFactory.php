<?php

namespace Ivan1986\PartsBundle\Service;

use Ivan1986\PartsBundle\Event\ConfigureMenuEvent;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\SecurityContext;

class EventMenuFactory {

    /** @var FactoryInterface */
    protected $factory;
    /** @var SecurityContext */
    protected $security;
    /** @var EventDispatcherInterface */
    private $events;

    public function __construct(FactoryInterface $factory, SecurityContext $security, EventDispatcherInterface $events) {
        $this->factory = $factory;
        $this->security = $security;
        $this->events = $events;
    }

    /**
     * Add items for exists menu
     *
     * @param string $name Event Name
     * @param ItemInterface $menuItem Menu Item
     * @return ItemInterface
     */
    public function addItems($name, ItemInterface $menuItem)
    {
        $this->events->dispatch('menuConfigure.'.$name,
            new ConfigureMenuEvent($this->factory, $this->security, $menuItem));
        return $menuItem;
    }

}