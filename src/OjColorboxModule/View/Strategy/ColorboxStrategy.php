<?php
namespace OjColorboxModule\View\Strategy;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use OjColorboxModule\Exception;
use Zend\Http\Response as HttpResponse;
use Zend\Mvc\MvcEvent;

class ColorboxStrategy extends AbstractListenerAggregate
{
    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH_ERROR, [$this, 'onError']);
    }
 
    /**
     * @param  MvcEvent $event
     * @return void
     */    
    public function onError(MvcEvent $event)
    {
        // Do nothing if no error or if response is not HTTP response
        if (!($exception = $event->getParam('exception') instanceof Exception\ExceptionInterface)
            || ($result = $event->getResult() instanceof HttpResponse)
            || !($response = $event->getResponse() instanceof HttpResponse)
        ) {
            return;
        }
        
        if ($exception instanceof Exception\ColorboxCloseException) {
            $vm = new ViewModel();
            $vm->setTemplate('oj-colorbox-module/colorbox-close');
            $vm->setTerminal(false);            
        } elseif ($exception instanceof Exception\ParentRedirectException) {
            $vm = new ViewModel(['redirect' => $url]);
            $vm->setTemplate('oj-colorbox-module/parent-redirect');
            $vm->setTerminal(false);            
        } elseif ($exception instanceof Exception\ParentReloadException) {
            $vm = new ViewModel();
            $vm->setTemplate('oj-colorbox-module/parent-refresh');
            $vm->setTerminal(false);            
        }
        
        $response = $event->getResponse() ?: new HttpResponse();
        $response->setStatusCode(200);

        $event->setResponse($response);
        $event->setResult($vm);                
    }    
}