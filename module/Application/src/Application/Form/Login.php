<?php

namespace Application\Form;

use Zend\Form\Form;

class Login extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->add(array(
            'name' => 'login_email',
            'options' => array('label' => 'Email Address'),
        ));

        $this->add(array(
            'name' => 'login_password',
            'options' => array('label' => 'Password'),
        ));

        $this->add(array('name' => 'submit',
                         'attributes' => array(
                            'type'  => 'submit',
                            'value' => 'Login &rarr;'),
        ));
    }
}
