<?php
namespace OjColorboxModule\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\Redirect;
use OjColorboxModule\Exception;

class ParentRedirect extends Redirect
{
    public function toUrl($url)
    {
        throw new Exception\ParentRedirectException($url);
    }

    public function refresh()
    {
        throw new Exception\ParentReloadException();
    }
}
