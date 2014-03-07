<?php

namespace spec\Hal;

use Hal\Link;
use Hal\Resource;
use PhpSpec\ObjectBehavior;

class ResourceCollectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Hal\ResourceCollection');
    }

    function it_returns_hal_array()
    {
        $uriOne = '/embedded-resource/1';
        $uriTwo = '/embedded-resource/2';
        $type = 'other';
        $group = 'others';
        $resourceOne = new Resource(new Link('self', $uriOne), $type);
        $resourceTwo = new Resource(new Link('self', $uriTwo), $type);

        $hal = array(
            $type => array(
                array(
                    '_links' => array(
                        'self' => array(
                            'href' => $uriOne
                        )
                    )
                ),
                array(
                    '_links' => array(
                        'self' => array(
                            'href' => $uriTwo
                        )
                    )
                )
            )
        );
        $this->addResource($resourceOne, 'others');
        $this->addResource($resourceTwo, 'others');
    }
}
