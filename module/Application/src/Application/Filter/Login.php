<?php

namespace Application\Filter;

use Zend\InputFilter\InputFilter;

class Login extends InputFilter
{
    public function __construct()
    {
        $this->add(array(
            'name' => 'login_email',
            'required' => true,
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('message' => 'Please enter your email.')),
                array('name' => 'EmailAddress', 'options' => array('message' => 'Please enter a valid email address.')),
            ),
            'filters' => array(
                array('name' => 'StringTrim'),
            ),
            'break_chain_on_failure' => true,
        ));

        $this->add(array(
            'name' => 'login_password',
            'required' => true,
            'validators' =>array(
                array('name' => 'NotEmpty', 'options' => array('message' => 'Please enter your password.')),
            ),
            'break_chain_on_failure' => true,
        ));
    }
}
