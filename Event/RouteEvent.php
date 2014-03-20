<?php

namespace Ivan1986\PartsBundle\Event;

use Ivan1986\PartsBundle\Routing\EventRouteLoader;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Routing\RouteCollection;

class RouteEvent extends Event
{

    /** @var EventRouteLoader */
    private $loader;
    /** @var RouteCollection */
    private $collection;

    public function __construct(EventRouteLoader $loader)
    {
        $this->loader = $loader;
        $this->collection = new RouteCollection();
    }

    /**
     * Add routes from annotation
     *
     * @param $bundle string Bundle name
     */
    public function importAnnotation($bundle)
    {
        $importedRoutes = $this->loader->import('@'.$bundle.'/Controller/', 'annotation');
        $this->collection->addCollection($importedRoutes);
    }

    public function getLoader()
    {
        return $this->loader;
    }

    public function getCollection()
    {
        return $this->collection;
    }

}
