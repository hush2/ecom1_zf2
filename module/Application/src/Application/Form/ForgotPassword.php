<?php

namespace Application\Form;

use Zend\Form\Form;

class ForgotPassword extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->add(array(
            'name' => 'email',
            'options' => array('label' => 'Email Address'),
        ));

        $this->add(array('name' => 'submit',
                         'attributes' => array(
                            'type'  => 'submit',
                            'value' => 'Reset &rarr;',
                            'class' => 'formbutton'),
        ));
    }
}
