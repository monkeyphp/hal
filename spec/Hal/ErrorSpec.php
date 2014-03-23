<?php

namespace spec\Hal;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ErrorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $message = 'Validation failed';
        $this->beConstructedWith($message);

        $this->shouldHaveType('Hal\Error');
    }

    // https://github.com/blongden/vnd.error
    // application/vnd.error+json
    function it_returns_hal_array()
    {
        // message
        // logref
        $message = 'Validation failed';
        $logref  = 42;

        $helpLink = new \Hal\Link('help', '/help', array('title' => 'Error Information'));
        $describesLink = new \Hal\Link('describes', '/error', array('title' => 'Error Description'));

        $this->beConstructedWith($message, $logref, $helpLink, $describesLink);

        $hal = array(
            'message' => $message,
            'logref'  => $logref,
            '_links' => array(
                'help' => array(
                    'href' => '/help',
                    'title' => 'Error Information'
                ),
                'describes' => array(
                    'href' => '/error',
                    'title' => 'Error Description'
                )
            )
        );

        $this->toArray()->shouldReturn($hal);
    }
}
