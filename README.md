Hal
===

A very simple Hal library for creating objects that can be turned into HAL compatible
payloads.

Links
-----

- https://phlyrestfully.readthedocs.org/en/latest/halprimer.html
- https://api-sandbox.foxycart.com/hal-browser/hal_browser.html#https://api-sandbox.foxycart.com/stores/8/transactions?zoom=items,payments
- http://stateless.co/hal_specification.html
- http://nocarrier.co.uk/2013/03/expanding-zoom/
- http://gotohal.net/

Use
---

Create the top level resource of your response.
All resources require an instance as Hal\Link as a constructor parameter and the 
type of the resource.

    $resource = new Resource(new Link('self', 'http://example.com/api/book/1'), 'book');

Now that we have our resource, we can add additional HAL attributes such as a ```_link```

    $resource->addLink(new Link('publisher', 'http://example.com/api/publisher/56'));

Or an ```_embedded``` resource

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

And add some ```attributes``` to the resource

    $resource->addAttributes(array(
        'title' => 'Animal Farm',
        'pages' => 112,
        'language' => 'English',
        'country' => 'United Kingdom'
    ));

Once you have created your Resource, you can output an array representation 

    $array = $resource->toArray();