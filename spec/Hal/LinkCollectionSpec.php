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
        $this->addLink(new Link('\example'))->shouldReturn($this);
    }

    function it_removes_link_and_returns_true()
    {
        $link = new Link('\example', 'foo');
        $this->addLink($link);

        $this->removeLink($link)->shouldReturn(true);

        $hal = array();

        $this->toArray()->shouldReturn($hal);
    }

    function it_returns_hal_array_of_links()
    {
        $uri = '/example';
        $name = 'next';
        $link = new Link($uri, $name);
        $hal =
            array(
                $name => array(
                    array(
                        'href' => $uri
                    ),
                ),

        );
        $this->addLink($link)->toArray()->shouldReturn($hal);
    }
}
