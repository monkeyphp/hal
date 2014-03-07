<?php
/**
 * Hal.php
 *
 * @category Hal
 * @package  Hal
 * @author   David White <david@monkeyphp.com>
 */
namespace Hal;

use Traversable;

/**
 * Hal
 *
 * A simple class that can be configured with various links, attributes and
 * embedded resources that should be capable of being used for rendering a HAL
 * compliant JSON or XML payload.
 *
 * @link http://tools.ietf.org/html/draft-kelly-json-hal-06#section-4
 * @link http://stateless.co/hal_specification.html
 *
 * @category Hal
 * @package  Hal
 */
class Resource
{
    /**
     * The name to use in the HAL output for links
     *
     * @link http://tools.ietf.org/html/draft-kelly-json-hal-06#section-4.1
     * @link http://tools.ietf.org/html/draft-kelly-json-hal-06#section-4.1.1
     *
     * @var string
     */
    const LINKS_KEY = '_links';

    /**
     * The name to use in the HAL output for embedded resource
     *
     * @link http://tools.ietf.org/html/draft-kelly-json-hal-06#section-4.1
     * @link http://tools.ietf.org/html/draft-kelly-json-hal-06#section-4.1.2
     *
     * @var string
     */
    const EMBEDDED_KEY = '_embedded';

    /**
     * The name to use in the HAL output for the self url
     *
     * @link http://tools.ietf.org/html/draft-kelly-json-hal-06#section-8.1
     *
     * @var string
     */
    const SELF_KEY = 'self';

    /**
     * The name to use in the HAL output for the href
     *
     * @link http://tools.ietf.org/html/draft-kelly-json-hal-06#section-5.1
     *
     * @var string
     */
    const HREF_KEY = 'href';

    /**
     * The Link that represents the self link the the HAL payload
     *
     * @var Link
     */
    protected $self;

    /**
     * An instance of LinkCollection that contains links to related resources
     *
     * @var LinkCollection
     */
    protected $links;

    /**
     * The name of the Resource
     *
     * @var string|null
     */
    protected $type;

    /**
     * An instance of ResourceCollection that is used to contain _embedded
     * resources
     *
     * @var ResourceCollection
     */
    protected $embedded;

    /**
     * An array containing Resource state attributes
     *
     * @var array
     */
    protected $attributes = array();

    /**
     * Constructor
     *
     * @param Link   $self The Link containing the self location
     * @param string $type The type of the resource
     *
     * @return void
     */
    public function __construct(Link $self, $type)
    {
        $this->setSelf($self);
        $this->setType($type);
    }

    /**
     * Set the type of the Resource
     *
     * @param string $type
     *
     * @return Resource
     */
    protected function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Return the type of the Resource
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add a Link to this Resource
     *
     * @param Link $link The Link to add
     *
     * @return Resource
     */
    public function addLink(Link $link)
    {
        $this->getLinks()->addLink($link);
        return $this;
    }

    /**
     * Set the self Link
     *
     * @param Link $self The Link
     *
     * @return Resource
     */
    protected function setSelf(Link $self)
    {
        $this->self = $self;
        return $this;
    }

    /**
     * Return the self Link
     *
     * @return Link
     */
    protected function getSelf()
    {
        return $this->self;
    }

    /**
     * Return the instance of LinkCollection
     *
     * @return LinkCollection
     */
    protected function getLinks()
    {
        if (! isset($this->links)) {
            $this->links = new LinkCollection();
        }
        return $this->links;
    }

    /**
     * Return a HAL compatible array
     *
     * @return array
     */
    public function toArray()
    {
        $hal = $links = $embedded = array();

        $links = $this->getSelf()->toArray();

        $links = array_merge($links, $this->getLinks()->toArray());

        $embedded = $this->getEmbedded()->toArray();

        if (! empty($links)) {
            $hal[self::LINKS_KEY] = $links;
        }
        if (! empty($embedded)) {
            $hal[self::EMBEDDED_KEY] = $embedded;
        }

        $hal = array_merge($hal, $this->attributes);

        return $hal;
    }

    /**
     * Add an embedded Resource
     *
     * @param Resource $resource The Resource to add
     * @param string   $group    The Resource group
     *
     * @return Resource
     */
    public function addEmbedded(Resource $resource, $group)
    {
        $this->getEmbedded()->addResource($resource, $group);
        return $this;
    }

    /**
     * Return the instance of ResourceCollection
     *
     * @return ResourceCollection
     */
    protected function getEmbedded()
    {
        if (! isset($this->embedded)) {
            $this->embedded = new ResourceCollection();
        }
        return $this->embedded;
    }

    /**
     * Add an attribute to the Resource
     *
     * @param string $name  The key/name of the attribute
     * @param mixed  $value The value of the attribute
     *
     * @return Resource
     */
    public function addAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    /**
     * Add an array of attributes to the Resource
     *
     * @param Traversable $attributes The array of attributes
     *
     * @return Resource
     */
    public function addAttributes($attributes = array())
    {
        if (is_array($attributes) || $attributes instanceof Traversable) {
            foreach ($attributes as $name => $value) {
                $this->addAttribute($name, $value);
            }
        }
        return $this;
    }
}
