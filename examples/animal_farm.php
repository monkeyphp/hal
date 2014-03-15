<?php
// @link http://en.wikipedia.org/wiki/Animal_Farm

require_once './../vendor/autoload.php';

use Hal\Link;
use Hal\Resource;

$resource = new Resource(new Link('self', 'http://example.com/api/book/1'), 'book');

$resource->addLink(new Link('publisher', 'http://example.com/api/publisher/56'));

$resource->addEmbedded(new Resource(
    new Link('self', 'http://exmaple.com/api/author/99'),
    'author',
    null,
    null,
    array(
        'name' => 'George Orwell',
        'born' => '25 June 1903',
        'died' => '21 January 1950'
    )
), 'author');

$resource->addAttributes(array(
    'title' => 'Animal Farm',
    'pages' => 112,
    'language' => 'English',
    'country' => 'United Kingdom'
));

$array = $resource->toArray();

echo json_encode($array, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);