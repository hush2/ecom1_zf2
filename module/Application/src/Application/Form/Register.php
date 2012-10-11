<?php

namespace Application\Form;

use Zend\Form\Form;

class Register extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->add(array('name' => 'first_name',
                         'options' => array('label' => 'First Name'),
        ));

        $this->add(array('name' => 'last_name',
                         'options' => array('label' => 'Last Name'),
        ));

        $this->add(array('name' => 'username',
                         'options' => array('label' => 'Desired Username'),
        ));

        $this->add(array('name' => 'email',
                         'options' => array('label' => 'Email Address'),
        ));

        $this->add(array('name' => 'pass',
                         'options' => array('label' => 'Password'),
        ));

        $this->add(array('name' => 'pass2',
                         'options' => array('label' => 'Confirm Password'),
        ));

        $this->add(array('name' => 'submit',
                         'attributes' => array(
                            'type'  => 'submit',
                            'value' => 'Next &rarr;',
                            'class' => 'formbutton'),
        ));
    }
}
