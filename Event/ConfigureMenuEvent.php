<?php

namespace Ivan1986\PartsBundle\Event;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Security\Core\SecurityContext;

class ConfigureMenuEvent extends Event
{
    /** @var FactoryInterface */
    protected $factory;
    /** @var SecurityContext */
    protected $security;
    /** @var ItemInterface */
    protected $menu;

    /**
     * @param \Knp\Menu\FactoryInterface $factory
     * @param \Knp\Menu\ItemInterface    $menu
     */
    public function __construct(FactoryInterface $factory, SecurityContext $security, ItemInterface $menu)
    {
        $this->factory = $factory;
        $this->security = $security;
        $this->menu = $menu;
    }

    /**
     * @return FactoryInterface
     */
    public function getFactory()
    {
        return $this->factory;
    }

    /**
     * @return ItemInterface
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * @return SecurityContext
     */
    public function getSecurity()
    {
        return $this->security;
    }

}
