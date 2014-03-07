<?php
/**
 * LinkFilter.php
 *
 * @category Hal
 * @package  Hal
 * @author   David White <david@monkeyphp.com>
 */
namespace Hal;

use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;

/**
 * LinkFilter
 *
 * @category Hal
 * @package  Hal
 */
class LinkFilter extends InputFilter
{
    public function __construct()
    {
        $this->add($this->getRelInput())
            ->add($this->getHrefInput())
            ->add($this->getNameInput())
            ->add($this->getTemplatedInput())
            ->add($this->getTypeInput())
            ->add($this->getDeprecationInput())
            ->add($this->getProfileInput())
            ->add($this->getTitleInput())
            ->add($this->getHreflangInput());
    }

    /**
     * Return the Input instance for the rel value
     *
     * ```rel``` is expected to be a string but may also be a url
     *
     * @link http://microformats.org/wiki/existing-rel-values
     * @link http://www.iana.org/assignments/link-relations/link-relations.xhtml
     *
     * @return Input
     */
    protected function getRelInput()
    {
        $rel = new Input('rel');
        $rel->setAllowEmpty(false);

        return $rel;
    }

    /**
     * Return the Input instance for the href value
     *
     * ```href``` should be a valid url (relative or absolute)
     *
     * The "href" property is REQUIRED.
     * Its value is either a URI [RFC3986] or a URI Template [RFC6570].
     *
     * If the value is a URI Template then the Link Object SHOULD have a
     * "templated" attribute whose value is true.
     *
     * @link http://tools.ietf.org/html/draft-kelly-json-hal-06#section-5.1
     * @link http://tools.ietf.org/html/rfc3986
     * @link http://tools.ietf.org/html/rfc6570
     *
     * @return Input
     */
    protected function getHrefInput()
    {
        $href = new Input('href');
        $href->setAllowEmpty(false);

        return $href;
    }

    /**
     * Return the Input instance used for the templated value
     *
     * @link http://tools.ietf.org/html/draft-kelly-json-hal-06#section-5.2
     *
     * @return Input
     */
    protected function getTemplatedInput()
    {
        $templated = new Input('templated');
        $templated->setAllowEmpty(true);

        return $templated;
    }

    /**
     * Return the Input instance used for the type value
     *
     * @return Input
     */
    protected function getTypeInput()
    {
        $type = new Input('type');
        $type->setAllowEmpty(true);

        return $type;
    }

    protected function getDeprecationInput()
    {
        $deprecation = new Input('deprecation');
        $deprecation->setAllowEmpty(true);

        return $deprecation;
    }

    protected function getProfileInput()
    {
        $profile = new Input('profile');
        $profile->setAllowEmpty(true);

        return $profile;
    }

    protected function getTitleInput()
    {
        $title = new Input('title');
        $title->setAllowEmpty(true);

        return $title;
    }

    protected function getHreflangInput()
    {
        $hrefLang = new Input('hreflang');
        $hrefLang->setAllowEmpty(true);

        return $hrefLang;
    }

    protected function getNameInput()
    {
        $hrefLang = new Input('name');
        $hrefLang->setAllowEmpty(true);

        return $hrefLang;
    }
}
