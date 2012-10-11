<?php

namespace Application\Form;

use Zend\Form\Form;

class AddPage extends Form
{
    public function __construct($categories)
    {
        parent::__construct();

        $this->add(array(
            'name' => 'title',
            'options' => array('label' => 'Title'),
        ));

        $options['none'] = 'Select One';
        foreach ($categories as $category) {
            $options[$category->id] = $category->category;
        }

        $this->add(array(
            'name' => 'categoryId',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Category',
                'value_options' => $options,
            ),
        ));

        $this->add(array(
            'name' => 'description',
            'options' => array('label' => 'Description'),
            'attributes' => array(
                'cols' => 75,
                'rows' => 5
            ),
        ));

        $this->add(array(
            'name'    => 'content',
            'options' => array('label' => 'Content'),
            'attributes' => array(
                'cols' => 75,
                'rows' => 5,
                'id'   => 'tinyeditor',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Add This Page',
                'class' => 'formbutton',
                'id'    => 'submit'
            ),
        ));
    }
}
