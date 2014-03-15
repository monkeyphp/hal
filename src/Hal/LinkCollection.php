<?php
/**
 * LinkCollection.php
 *
 * @category Hal
 * @package  Hal
 * @author   David White <david@monkeyphp.com>
 */
namespace Hal;

use SplObjectStorage;

/**
 * LinkCollection
 *
 * @category Hal
 * @package  Hal
 */
class LinkCollection
{
    /**
     * Instance of SplObjectStorage
     *
     * @var SplObjectStorage
     */
    protected $links;

    /**
     * Add a Link to the Collection
     *
     * @param Link $link
     *
     * @return LinkCollection
     */
    public function addLink(Link $link)
    {
        $this->getLinks()->attach($link);
        return $this;
    }

    /**
     * Remove a Link from the Collection
     *
     * @param Link $link
     *
     * @return boolean
     */
    public function removeLink(Link $link)
    {
        if ($this->getLinks()->contains($link)) {
            $this->getLinks()->detach($link);
            return true;
        }
        return false;
    }

    /**
     * Return a HAL payload array
     *
     * This method will loop through each link adding each to the links array.
     * If there are multiple links with same ```rel``` value, they will be
     * converted into an array.
     *
     * @return array
     */
    public function toArray()
    {
        $hal = array();

        foreach ($this->getLinks() as $link) {
            $array = $link->toArray();

            $key = key($array);
            $current = current($array);

            if (isset($hal[$key])) {
                $hal[$key] = array($hal[$key], $current);
                continue;
            }
            $hal[$key] = $current;
        }

        return $hal;
    }

    /**
     * Return an instance of SplObjectStorage
     *
     * @return SplObjectStorage
     */
    protected function getLinks()
    {
        if (! isset($this->links)) {
            $this->links = new SplObjectStorage();
        }
        return $this->links;
    }
}
