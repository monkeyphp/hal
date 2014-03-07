<?php
// https://phlyrestfully.readthedocs.org/en/latest/halprimer.html
require_once './../vendor/autoload.php';

use Hal\Link;
use Hal\Resource;

$resource = new Resource(
    new Link('self', 'http://example.org/api/user?page=3'),
    'users',
    array(
        new Link('first', "http://example.org/api/user"),
        new Link('prev', "http://example.org/api/user?page=2"),
        new Link('next', "http://example.org/api/user?page=4"),
        new Link('last', "http://example.org/api/user?page=33"),
    ),
    array(
        'users' => array(
            new Resource(new Link('self', 'http://example.org/api/user/mwop'), 'user', null, null, array('id' => 'mwop', 'name' => 'Matthew Weier O\'Phinney')),
            new Resource(new Link('self', 'http://example.org/api/user/mac_nibblet'), 'user', null, null, array('id' => 'mac_nibblet', 'name' => 'Antoine Hedgecock')),
            new Resource(new Link('self', 'http://example.org/api/user/spiffyjr'), 'user', null, null, array('id' => 'spiffyjr', 'name' => 'Kyle Spraggs')),
        )
    )

);


print_r($resource->toArray());