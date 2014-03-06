<?php
/**
 * ResourceCollection.php
 *
 * @category Hal
 * @package  Hal
 * @author   David White <david@monkeyphp.com>
 */
namespace Hal;

use SplObjectStorage;

/**
 * ResourceCollection
 *
 * @category Hal
 * @package  Hal
 */
class ResourceCollection
{
    /**
     * Instance of SplStorageObject
     *
     * @var SplObjectStorage
     */
    protected $resources;

    /**
     * Add a resource to this ResourceCollection
     *
     * @param Resource $resource
     * @param string   $group
     *
     * @return ResourceCollection
     */
    public function addResource(Resource $resource, $group)
    {
        $this->getResources()->attach($resource, $group);
        return $this;
    }

    /**
     * Return a instance of SplObjectStorage
     *
     * @return SplObjectStorage
     */
    protected function getResources()
    {
        if (! isset($this->resources)) {
            $this->resources = new SplObjectStorage();
        }
        return $this->resources;
    }

    /**
     * Return a HAL compatible payload array
     * 
     * @return array
     */
    public function toArray()
    {
        $hal = array();

        foreach ($this->getResources() as $resource) {

            $group = $this->getResources()->getInfo();

            if (! isset($hal[$group])) {
                $hal[$group] = array();
            }

            $hal[$group][] = $resource->toArray();
        }

        return $hal;
    }
}
