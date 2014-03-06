<?php
require_once 'vendor/autoload.php';

use Hal\Link;
use Hal\Resource;


$self = new Link('/customer/123');
$resource = new Resource($self, 'customer');

$resource->addAttributes(
    array(
        'firstname' => 'David',
        'lastname' => 'White',
        'age' => 32
    )
);

$address = new Resource(new Link('/address/8212'), 'address');
$address->addAttributes(
    array(
        'street' => 'Albert Road',
        'town' => 'Harrogate',
        'postcode' => 'HG1 111'
    )
);

$purchase1 = new Resource(new Link('/purhase/1342'), 'purchase');
$purchase2 = new Resource(new Link('/purhase/1243'), 'purchase');
$purchase3 = new Resource(new Link('/purhase/1123'), 'purchase');

$resource->addEmbedded($address, 'address');
$resource->addEmbedded($purchase1, 'purchases');
$resource->addEmbedded($purchase2, 'purchases');
$resource->addEmbedded($purchase3, 'purchases');

print_r($resource->toArray());