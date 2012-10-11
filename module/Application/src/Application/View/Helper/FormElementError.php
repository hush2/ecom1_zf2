<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class FormElementError extends AbstractHelper
{
    public function __invoke($element)
    {            
        $messages = $element->getMessages();        
        if (!empty($messages)) {
            return '<span class="error">' . array_shift($messages) . '</span>';
        }
    }
}
