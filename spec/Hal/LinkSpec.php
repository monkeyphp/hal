<?php

namespace spec\Hal;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LinkSpec extends ObjectBehavior
{
    public function it_returns_uri()
    {
        $uri = '/users?page=2';
        $this->beConstructedWith($uri);

        $this->getUri()->shouldReturn($uri);
    }

    public function it_returns_name_when_set()
    {
        $name = 'next';
        $this->beConstructedWith('/users?page=1', $name);

        $this->getName()->shouldReturn($name);
    }

    public function it_returns_null_when_name_not_set()
    {
        $this->beConstructedWith('/users?page=2');

        $this->getName()->shouldReturn(null);
    }
}
