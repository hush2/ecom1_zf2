<?php

namespace Application\View\Helper;

class Selected extends AbstractHelperWithServiceManager
{
    public function __invoke($path)
    {
        $request = $this->sm->getServiceLocator()->get('Request');
        $end = end(explode('/', $request->getUri()));
        if ($end == $path) {
            return 'class="selected"';
        }
    }
}
