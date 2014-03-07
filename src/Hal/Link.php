<?php
/**
 * Link.php
 *
 * @category Hal
 * @package  Hal
 * @author   David White <david@monkeyphp.com>
 */
namespace Hal;

use Exception;

/**
 * Link
 *
 * @link http://tools.ietf.org/html/draft-kelly-json-hal-06#section-5
 * @link http://www.iana.org/assignments/link-relations/link-relations.xhtml
 * @link http://microformats.org/wiki/existing-rel-values
 *
 * @category Hal
 * @package  Hal
 */
class Link
{
    /**
     * Instance of LinkFilter used for validating and filtering the
     * supplied parameters
     *
     * @var LinkFilter
     */
    protected $linkFilter;

    /**
     * An array of filtered values
     *
     * @var array
     */
    protected $values;

    /**
     * Constructor
     *
     * @param string $rel     The relationship
     * @param string $href    The uri/href
     * @param array  $options An array of optional values
     *
     * @return void
     */
    public function __construct($rel, $href, $options = array())
    {
        $options = ($options + array('rel' => $rel, 'href' => $href));

        $linkFilter = $this->getLinkFilter();
        $linkFilter->setData($options);

        if (! $linkFilter->isValid()) {
            throw new Exception('Invalid data supplied');
        }

        $this->values = array_filter($linkFilter->getValues(), 'strlen');
    }

    /**
     * Return an array representation of the Hal link
     *
     * @return array
     */
    public function toArray()
    {
        $values = $this->values;
        $rel = $values['rel'];
        unset($values['rel']);

        return array($rel => $values);
    }

    /**
     * Return an instance of LinkFilter
     *
     * @return LinkFilter
     */
    protected function getLinkFilter()
    {
        if (! isset($this->linkFilter)) {
            $this->linkFilter = new LinkFilter();
        }
        return $this->linkFilter;
    }
}
