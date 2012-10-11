<?php

namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class GetService extends AbstractPlugin
{
    public function __invoke($name)
    {
        $sm = $this->getController()->getServiceLocator();
        return $sm->get($name);
    }
}
