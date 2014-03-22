<?php
namespace OjColorboxModule\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\View\Model\ViewModel;
use OjColorboxModule\Exception\ColorboxCloseException;

class ColorboxClose extends AbstractPlugin
{
    public function __invoke()
    {
        throw new ColorboxCloseException();       
    }
}
