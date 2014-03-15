<?php

namespace spec\Hal;

use Hal\Link;
use PhpSpec\ObjectBehavior;

class LinkCollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Hal\LinkCollection');
    }

    function it_returns_this_when_link_added()
    {
        $this->addLink(new Link('profile', '/example'))->shouldReturn($this);
    }

    function it_returns_hal_array()
    {
        $this->addLink(new Link('basket', '/basket/280735', array('name' => 'Basket')));
        $this->addLink(new Link('profile', '/profile/123'));
        $this->addLink(new Link('profile', '/this-customer-123'));

        $hal = array(
            'basket' => array(
                'href' => '/basket/280735',
                'name' => 'Basket'
            ),
            'profile' => array(
                array(
                    'href' => '/profile/123'
                ),
                array(
                    'href' => '/this-customer-123'
                )
            )
        );

        $this->toArray()->shouldReturn($hal);
    }

}
