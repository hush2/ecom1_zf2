<?php

namespace Application\View\Helper;

use Zend\ServiceManager\ServiceManager,
    Zend\ServiceManager\ServiceManagerAwareInterface,
    Zend\View\Helper\AbstractHelper;

class AbstractHelperWithServiceManager extends AbstractHelper
                                       implements ServiceManagerAwareInterface
{
    public function setServiceManager(ServiceManager $pluginManager)
    {
        $this->sm = $pluginManager;
    }
}
