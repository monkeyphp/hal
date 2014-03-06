<?php

namespace spec\Hal;

use Hal\Link;
use Hal\Resource;
use PhpSpec\ObjectBehavior;

class ResourceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $type = 'person';
        $this->beConstructedWith(new Link('\me'), $type);

        $this->shouldHaveType('Hal\Resource');
    }

    function it_returns_this_when_link_added()
    {
        $type = 'person';
        $this->beConstructedWith(new Link('\me'), $type);

        $link = new Link('\other', 'next');

        $this->addLink($link)->shouldReturn($this);
    }

    function it_returns_this_when_resource_added()
    {
        $embedded = new Resource(new Link('\orders\1'), 'order');

        $this->beConstructedWith(new Link('\customer\123'), 'customer');

        $this->addEmbedded($embedded, 'orders')->shouldReturn($this);
    }

    function it_returns_this_when_attribute_added()
    {
        $this->beConstructedWith(new Link('\customer\123'), 'customer');

        $this->addAttribute('name', 'David')->shouldReturn($this);
    }


    function it_returns_hal_array()
    {
        $selfUri = '/customer/123';
        $otherUri = '/profile/123';
        $name = 'profile';

        $type = 'order';
        $firstEmbeddedUri = '/order/1';
        $firstEmbedded = new Resource(new Link($firstEmbeddedUri), $type);

        $myName = 'The Hulk';
        $myAge = 30;

        $hal = array(
            '_links' => array(
                'self' => array(
                    'href' => $selfUri
                ),
                $name => array(
                    array(
                        'href' => $otherUri
                    ),
                ),
            ),
            '_embedded' => array(
                'orders' => array(
                    array(
                        '_links' => array(
                            'self' => array(
                                'href' => $firstEmbeddedUri
                            ),
                        ),
                    ),
                ),
            ),
            'name' => $myName,
            'age' => $myAge,
        );

        $this->beConstructedWith(new Link($selfUri), 'customer');
        $this->addLink(new Link($otherUri, $name));
        $this->addAttribute('name', $myName);
        $this->addAttribute('age', $myAge);
        $this->addEmbedded($firstEmbedded, 'orders');

        $this->toArray()->shouldReturn($hal);
    }
}
