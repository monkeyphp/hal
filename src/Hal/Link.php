<?php
/**
 * Link.php
 *
 * @category Hal
 * @package  Hal
 * @author   David White <david@monkeyphp.com>
 */
namespace Hal;

/**
 * Link
 *
 * @link http://tools.ietf.org/html/draft-kelly-json-hal-06#section-5
 *
 * @category Hal
 * @package  Hal
 */
class Link
{
    /**
     * Required
     *
     * @link http://tools.ietf.org/html/draft-kelly-json-hal-06#section-5.1
     *
     * @var string
     */
    protected $href;

    /**
     * Optional
     *
     * http://tools.ietf.org/html/draft-kelly-json-hal-06#section-5.2
     *
     * @var boolean|null
     */
    protected $templated = false;

    /**
     * Optional
     *
     * @link http://tools.ietf.org/html/draft-kelly-json-hal-06#section-5.3
     *
     * @var string|null
     */
    protected $type;

    /**
     * Optional
     *
     * @link http://tools.ietf.org/html/draft-kelly-json-hal-06#section-5.4
     *
     * @var string|null
     */
    protected $deprecation;

    /**
     * @link http://tools.ietf.org/html/draft-kelly-json-hal-06#section-5.5
     *
     * @var string
     */
    protected $name;

    /**
     * @link http://tools.ietf.org/html/draft-kelly-json-hal-06#section-5.6
     *
     * @var string|null
     */
    protected $profile;

    /**
     * @link http://tools.ietf.org/html/draft-kelly-json-hal-06#section-5.7
     *
     * @var string|null
     */
    protected $title;

    /**
     * @link http://tools.ietf.org/html/draft-kelly-json-hal-06#section-5.8
     *
     * @var string
     */
    protected $hreflang;


    public function __construct($uri, $name = null)
    {
        $this->href = $uri;
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUri()
    {
        return $this->href;
    }
}
