<?php

namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class IsFormValid extends AbstractPlugin
{
    public function __invoke($form)
    {
        $request = $this->getController()->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            return $form->isValid();
        }
    }
}
