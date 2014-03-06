<?php
require_once 'vendor/autoload.php';

use Hal\Link;
use Hal\Resource;

$self = new Link('/customer/123');
$orders = new Link('/customer/123/orders', 'orders');
$payments = new Link('/customer/123/payments', 'payments');


$hal = new Resource($self, 'customer');
$hal->addLink($orders);
$hal->addLink($payments);

$hal->addAttribute('name', 'Hulk');
$hal->addAttribute('age', 30);

$address = new Resource(new Link('/address/456'), 'address');
$address->addAttribute('street', 'Albert Road');
$address->addAttribute('town', 'Harrogate');

$hal->addEmbedded($address, 'addresses');

print_r($hal->toArray());