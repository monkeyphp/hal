<?php
require_once './../vendor/autoload.php';

use Hal\Link;
use Hal\Resource;

// create the top level resource
$resource = new Resource(new Link('self', '/customer/123'), 'customer');

// add some attributes to the resource
$resource->addAttributes(array(
    'firstname' => 'David',
    'lastname' => 'White',
    'age' => 32
));

// add some embedded resources
$address = new Resource(new Link('self', '/address/23987'), 'address');
$address->addAttributes(array(
    'street' => 'A Road',
    'town' => 'Harrogate',
    'county' => 'North Yorkshire'
));
$resource->addEmbedded($address, 'addresses');

// add some links
$orders = new Link('orders', '/customer/123/orders');
$payments = new Link('payments', '/customer/123/payments');

$resource->addLink($orders);
$resource->addLink($payments);

// print out the resulting array
print_r($resource->toArray());