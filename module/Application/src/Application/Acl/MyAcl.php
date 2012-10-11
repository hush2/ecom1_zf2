<?php

namespace Application\Acl;

use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

class MyAcl extends Acl
{
    public function __construct()
    {
        $this->addRole(new Role('guest'));
        $this->addRole(new Role('member'));
        $this->addRole(new Role('admin'));

        $this->addResource(new Resource('Application/Controller/Account'));
        $this->addResource(new Resource('Application/Controller/Content'));
        $this->addResource(new Resource('Application/Controller/Admin'));

        $this->deny('guest', 'Application/Controller/Content', 'history');
        $this->deny('guest', 'Application/Controller/Content', 'favorites');        
        $this->allow('guest', 'Application/Controller/Account', 'login');
        $this->allow('guest', 'Application/Controller/Account', 'register');
        $this->allow('guest', 'Application/Controller/Account', 'forgotpassword');
        $this->allow('guest', 'Application/Controller/Content', null);
        
        $this->deny('member', 'Application/Controller/Account', 'register');
        $this->deny('member', 'Application/Controller/Account', 'forgotpassword');
        $this->allow('member', 'Application/Controller/Content', null);
        $this->allow('member', 'Application/Controller/Account', null);

        $this->allow('admin');
    }
}
