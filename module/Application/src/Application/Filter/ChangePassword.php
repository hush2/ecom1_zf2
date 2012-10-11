<?php

namespace Application\Filter;

use Zend\InputFilter\InputFilter,
    Zend\InputFilter\Input;

class ChangePassword extends InputFilter
{
    public function __construct($dbAdapter, $userId)
    {
        $password = new Input('current_password');
        $password->getValidatorChain()
                 ->addValidator(new \Zend\Validator\NotEmpty(array('message' => 'Please enter your password.')))
                 ->addValidator(new \Application\Validator\CorrectPassword($dbAdapter, $userId));
        $this->add($password);

        $this->add(array(
            'name'     => 'new_password',
            'required' => true,
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('message' => 'Please enter your new password.')),
                array('name' => 'Regex', 'options' => array('pattern' => '/^(\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])\w*)+/',
                                                            'message' => 'Password format is not valid.'))),
            'break_chain_on_failure' => true,
        ));

        $this->add(array(
            'name'     => 'confirm_password',
            'required' => true,
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('message' => 'Please confirm your password.')),
                array('name' => 'Identical', 'options' => array('token' => 'new_password', 'message' => 'Your new password and confirm password does not match.'))),
            'break_chain_on_failure' => true,
        ));
        
        //return $this;
    }
}
