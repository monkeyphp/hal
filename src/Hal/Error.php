<?php

namespace Hal;

class Error implements ResourceInterface
{
    const LINKS_KEY = '_links';

    protected $message;

    protected $logref;

    public function __construct(
        $message,
        $logref = null,
        \Hal\Link $helpLink = null,
        \Hal\Link $describesLink = null)
    {
        $this->setMessage($message);
        $this->setLogref($logref);
        $this->setHelpLink($helpLink);
        $this->setDescribesLink($describesLink);
    }

    protected function getMessage()
    {
        return $this->message;
    }

    protected function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    protected function getLogref()
    {
        return $this->logref;
    }

    protected function setLogref($logref = null)
    {
        $this->logref = $logref;
        return $this;
    }

    protected function getHelpLink()
    {
        return $this->helpLink;
    }

    protected function setHelpLink(Link $helpLink = null)
    {
        $this->helpLink = $helpLink;
        return $this;
    }

    protected function setDescribesLink(Link $describesLink = null)
    {
        $this->describesLink = $describesLink;
        return $this;
    }

    protected function getDescribesLink()
    {
        return $this->describesLink;
    }

    public function toArray()
    {
        $links = array_merge(
            ($this->getHelpLink())      ? $this->getHelpLink()->toArray()      : array(),
            ($this->getDescribesLink()) ? $this->getDescribesLink()->toArray() : array()
        );

        $hal = array(
            'message' => $this->getMessage(),
            'logref'  => $this->getLogref(),
        );

        if (! empty($links)) {
            $hal[self::LINKS_KEY] = $links;
        }

        return $hal;
    }
}
