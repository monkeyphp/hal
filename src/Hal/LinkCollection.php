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
     * @return array
     */
    public function toArray()
    {
        $hal = array();

        foreach ($this->getLinks() as $link) {
            $name = $link->getName();

            if (! $name || $name === 'self') {
                continue;
            }

            if (! isset($hal[$name])) {
                $hal[$name] = array();
            }

            $hal[$name][] = array(
                'href' => $link->getUri()
            );
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
