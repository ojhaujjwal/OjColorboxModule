<?php
namespace OjColorboxModule\Exception;

class ParentRedirectException extends \RuntimeException implements ExceptionInterface
{
    protected $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }
}
