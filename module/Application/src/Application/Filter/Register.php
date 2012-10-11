<?php

namespace Application\Filter;

use Zend\InputFilter\InputFilter;

class Register extends InputFilter
{
    public function __construct($dbAdapter)
    {
        $this->add(array(
            'name' => 'first_name',
            'required' => true,
            'filters' => array(array('name' => 'StringTrim')),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('message' => 'Please enter your first name.')),
                array('name' => 'StringLength', 'options' => array('min' => 2, 'max' => 30, 'message' => 'Username must be %min% to %max% characters.')),
                array('name' => 'Regex',  'options' => array('pattern' => '/^[A-Z \'.-]+$/i',
                                                             'message' => 'Please enter a valid first name.'))),
            'break_chain_on_failure' => true,
        ));

        $this->add(array(
            'name' => 'last_name',
            'required' => true,
            'filters' => array(array('name' => 'StringTrim')),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('message' => 'Please enter your last name.')),
                array('name' => 'StringLength', 'options' => array('min' => 2, 'max' => 30, 'message' => 'Last name must be %min% to %max% characters.')),
                array('name' => 'Regex',  'options' => array('pattern' => '/^[A-Z \'.-]+$/i',
                                                             'message' => 'Please enter a valid last name.'))),
            'break_chain_on_failure' => true,
        ));

        $this->add(array(
            'name' => 'username',
            'required' => true,
            'filters' => array(array('name' => 'StringTrim')),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('message' => 'Please enter your desired username.')),
                array('name' => 'Zend\Validator\Db\NoRecordExists',
                        'options' => array('table'   => 'users',
                                           'adapter' => $dbAdapter,
                                           'field'   => 'username',
                                           'message' => 'This username has already been registered. Please try another.'))),
            'break_chain_on_failure' => true,
        ));

        $this->add(array(
            'name' => 'email',
            'required' => true,
            'filters' => array(array('name' => 'StringTrim')),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('message' => 'Please enter your email.')),
                array('name' => 'EmailAddress', 'options' => array('message' => 'Please enter a valid email address.')),
                array('name' => 'Zend\Validator\Db\NoRecordExists',
                        'options' => array('table'   => 'users',
                                           'adapter' => $dbAdapter,
                                           'field'   => 'email',
                                           'message' => 'This email address has already been registered. Please try another.'))),
            'break_chain_on_failure' => true,
        ));

        $this->add(array(
            'name' => 'pass',
            'required' => true,
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('message' => 'Please enter your password.')),
                array('name' => 'StringLength', 'options' => array('min' => 6, 'max' => 20, 'message' => 'Password must be %min% to %max% characters.')),
                array('name' => 'Regex', 'options' => array('pattern' => '/^(\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])\w*)+/',
                                                            'message' => 'Password format is not valid.'))),
            'break_chain_on_failure' => true,
        ));

        $this->add(array(
            'name' => 'pass2',
            'required' => true,
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('message' => 'Please confirm your password.')),
                array('name' => 'Identical', 'options' => array('token' => 'pass', 'message' => 'Your new password and confirm password does not match.'))),
            'break_chain_on_failure' => true,
        ));
    }
}
