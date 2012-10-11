<?php

namespace Application\Validator;

use Application\Model,
    Zend\Validator\AbstractValidator;

class CorrectPassword extends AbstractValidator
{
    protected $messageTemplates = array(
                'failed' => 'Current password is incorrect.');

    public function __construct($model, $userId)
    {
        parent::__construct();
        
        $this->id = $userId;
        $this->user = $model;        
    }

    public function isValid($value)
    {
        $row = $this->user->select(array('id' => $this->id));
        if ($row->count() > 0) {
            if ($row->current()->pass == $this->user->hash($value)) {
                return true;
            }
        }
        $this->error('failed');
    }
}
