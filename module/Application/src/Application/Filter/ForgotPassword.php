<?php

namespace Application\Filter;

use Zend\InputFilter\InputFilter;

class ForgotPassword extends InputFilter
{
    public function __construct($dbAdapter)
    {
        $this->add(array(
            'name'     => 'email',
            'required' => true,
            'filters'  => array(
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('message' => 'Please enter your email.')),
                array('name' => 'EmailAddress', 'options' => array('message' => 'Please enter a valid email address.')),
                array('name' => 'RecordExists', 'options' => array(
                                                    'table'   => 'users',
                                                    'adapter' => $dbAdapter,
                                                    'field'   => 'email',
                                                    'message' => 'The submitted email address does not match those on file!')),
            'break_chain_on_failure' => true,
            )));
    }
}
