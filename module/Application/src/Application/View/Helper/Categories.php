<?php

namespace Application\View\Helper;

class Categories extends AbstractHelperWithServiceManager
{
    public function __invoke()
    {
        $dbAdapter = $this->sm->getServiceLocator()->get('dbAdapter');
        $category = new \Application\Model\Category($dbAdapter);
        return $category->all();
    }
}
