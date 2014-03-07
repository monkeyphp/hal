<?php

namespace spec\Hal;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LinkSpec extends ObjectBehavior
{
    public function it_returns_hal_array()
    {
        $rel = 'self';
        $href = '/example';
        $templated = true;
        $type = 'application/pdf';
        $deprecation = '/deprecation.html';
        $profile = 'some-kind of_string';
        $title = 'a title';
        $hreflang = 'ahreflang';

        $this->beConstructedWith(
            $rel,
            $href,
            array(
                'templated' => $templated,
                'type' => $type,
                'deprecation' => $deprecation,
                'profile' => $profile,
                'title' => $title,
                'hreflang' => $hreflang
            )
        );

        $hal = array(
            $rel => array(
                'href' => $href,
                'templated' => true,
                'type' => $type,
                'deprecation' => $deprecation,
                'profile' => $profile,
                'title' => $title,
                'hreflang' => $hreflang,
            )
        );

        $this->toArray()->shouldReturn($hal);
    }

}
