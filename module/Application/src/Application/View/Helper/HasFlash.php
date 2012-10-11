<?php

namespace Application\View\Helper;

class HasFlash extends AbstractHelperWithServiceManager
{
    public function __invoke($namespace=null)
    {
        $flashMessenger = $this->sm->getServiceLocator()
                                   ->get('ControllerPluginManager')
                                   ->get('FlashMessenger');
        if ($namespace) {
            $flashMessenger->setNamespace($namespace);
        }
        return $flashMessenger->hasMessages();
    }
}
