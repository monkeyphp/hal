<?php
require_once './../vendor/autoload.php';

use Hal\Link;
use Hal\Resource;

// create the top level resource
$purchase = new Resource(
    new Link('self', '/purchase/12234234'),
    'purchase',
    array(
        new Link('payment', '/payment/9080'),
        new Link('contact', '/contact/8992'),
        new Link('shipping', '/shipping/1922'),
    ),
    array(
        'items' => array(
            new Resource(new Link('self', '/item/12'), 'item', null, null, array('quantity' => 1)),
            new Resource(new Link('self', '/item/23'), 'item', null, null, array('quantity' => 2)),
            new Resource(new Link('self', '/item/45'), 'item', null, null, array('quantity' => 1)),
            new Resource(new Link('self', '/item/99'), 'item', null, null, array('quantity' => 3)),
        )
    ),
    array(
       'date' => '2014-03-07'
    )
);

print_r($purchase->toArray());