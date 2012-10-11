<?php

namespace Application\Form;

class ChangePassword extends \Zend\Form\Form
{
    public function __construct()
    {
        parent::__construct();

        $this->add(array(
            'name'    => 'current_password',
            'options' => array('label' => 'Current Password'),
        ));

        $this->add(array(
            'name'    => 'new_password',
            'options' => array('label' => 'New Password'),
        ));

        $this->add(array(
            'name'    => 'confirm_password',
            'options' => array('label' => 'Confirm New Password'),
        ));

        $this->add(array('name' => 'submit',
                         'attributes' => array(
                            'type'  => 'submit',
                            'value' => 'Change &rarr;',
                            'class' => 'formbutton'),
        ));
    }
}
