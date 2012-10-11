<?php

namespace Application\Filter;

use Zend\InputFilter\InputFilter;

class AddPage extends InputFilter
{
    public function __construct($dbAdapter)
    {
        $this->add(array(
            'name' => 'title',
            'required' => true,
            'filters' => array(array('name' => 'StringTrim')),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('message' => 'Please enter a title.')),
                array('name' => 'StringLength', 'options' => array('min' => 2, 'max' => 64, 'message' => 'Title must be %min% to %max% characters.')),
            ),
            'break_chain_on_failure' => true,
        ));

        $this->add(array(
            'name' => 'categoryId',
            'required' => true,
            'validators' => array(
                array('name' => 'Digits', 'options' => array('message' => 'Please select a category!')),
                array('name' => 'Zend\Validator\Db\NoRecordExists',
                        'options' => array('table'   => 'categories',
                                           'adapter' => $dbAdapter,
                                           'field'   => 'category'))
            ),
            'break_chain_on_failure' => true,
        ));

        $this->add(array(
            'name' => 'description',
            'required' => true,
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('message' => 'Please enter some description')),
                array('name' => 'StringLength', 'options' => array('min' => 2, 'max' => 128, 'message' => 'Description must be %min% to %max% characters.')),
            ),
            'break_chain_on_failure' => true,
        ));

        $this->add(array(
            'name' => 'content',
            'required' => true,
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('message' => 'Please enter some content.')),
                array('name' => 'StringLength', 'options' => array('min' => 2, 'max' => 512, 'message' => 'Content must be %min% to %max% characters.')),
            ),
            'break_chain_on_failure' => true,
        ));
    }
}
