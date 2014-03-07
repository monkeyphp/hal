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

    protected function getRelInput()
    {
        $rel = new Input('rel');
        $rel->setAllowEmpty(false);

        return $rel;
    }

    protected function getHrefInput()
    {
        $href = new Input('href');
        $href->setAllowEmpty(false);

        return $href;
    }

    protected function getTemplatedInput()
    {
        $templated = new Input('templated');
        $templated->setAllowEmpty(true);

        return $templated;
    }

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
