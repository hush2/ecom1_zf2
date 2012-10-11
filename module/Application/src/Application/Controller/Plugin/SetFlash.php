<?php

namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class SetFlash extends AbstractPlugin
{
    public function __invoke($message=null, $namespace=null)
    {
        $flash = $this->getController()->plugin('FlashMessenger');
        if ($namespace) {
            $flash->setNamespace($namespace);
        }
        $flash->addMessage($message);
    }
}
