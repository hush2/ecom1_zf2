<?php

namespace Application\Form;

use Zend\Form\Form;

class AddPdf extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->add(array(
            'name' => 'title',
            'options' => array('label' => 'Title'),
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
            'name' => 'pdf',
            'options' => array('label' => 'PDF'),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Add This PDF',
                'class' => 'formbutton',
            ),
        ));
    }
}
