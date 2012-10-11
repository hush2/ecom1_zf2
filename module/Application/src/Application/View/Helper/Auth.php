<?php

namespace Application\View\Helper;

class Auth extends AbstractHelperWithServiceManager
{
    public function __invoke()
    {
        return $this->sm->getServiceLocator()->get('auth');
    }
}
