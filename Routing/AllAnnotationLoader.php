<?php

namespace Ivan1986\PartsBundle\Routing;

use Symfony\Component\Config\Exception\FileLoaderLoadException;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\RouteCollection;

class AllAnnotationLoader extends Loader {

    protected $bundles;

    public function __construct($bundles)
    {
        $this->bundles = $bundles;
    }

    /**
     * Loads a resource.
     *
     * @param mixed $resource The resource
     * @param string $type The resource type
     */
    public function load($resource, $type = null)
    {
        $collection = new RouteCollection();
        foreach($this->bundles as $name=>$class) {
            try {
                $items = $this->import('@' . $name . '/Controller/', 'annotation');
                $collection->addCollection($items);
            } catch (FileLoaderLoadException $e) {
                continue; //файл не найден
            }
        }
        return $collection;
    }

    /**
     * Returns true if this class supports the given resource.
     *
     * @param mixed $resource A resource
     * @param string $type The resource type
     *
     * @return bool    true if this class supports the given resource, false otherwise
     */
    public function supports($resource, $type = null)
    {
        return $type === 'annotations';
    }


} 