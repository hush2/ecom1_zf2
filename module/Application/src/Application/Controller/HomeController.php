<?php

namespace Application\Controller;

class HomeController extends \Zend\Mvc\Controller\AbstractActionController
{
    public function indexAction()
    {    
        $history = $this->getService('Model\History');
        return array('mostPopular' => $history->mostPopular());
    }

    public function aboutAction() { }
    public function contactAction() { }
}
