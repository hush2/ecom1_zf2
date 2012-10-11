<?php

namespace Application\Controller;

use Application\Form,
    Application\Filter,
    Application\Controller\Exception\MyException;

class AdminController extends \Zend\Mvc\Controller\AbstractActionController
{
    //--------------------------------------------------------------------------
    // Show/process Add Page form.
    //--------------------------------------------------------------------------
    public function addpageAction()
    {
        $category = $this->getService('Model/Category');
        $form = new Form\AddPage($category->all());

        $dbAdapter = $this->getService('dbAdapter');
        $form->setInputFilter(new Filter\AddPage($dbAdapter));
        if ($this->isFormValid($form)) {
            $page = $this->getService('Model\Page');
            if ($page->add($form->getData())) {
                $this->setFlash(true, 'success');
                return $this->redirect()->toUrl('add_page');
            }
            throw new MyException('The page could not be added due to a system error. We apologize for any inconvenience.');
        }
        return array('form' => $form);
    }

    //--------------------------------------------------------------------------
    // Show form/process submitted PDF file.
    //
    // TODO: move validators/filter to an input filter file.
    //--------------------------------------------------------------------------
    public function addpdfAction()
    {
        $form = new Form\AddPdf();
        $form->setInputFilter(new Filter\AddPdf());
        if ($this->isFormValid($form)) {
            $upload = new \Zend\File\Transfer\Adapter\Http();
            $upload->setValidators(array(
                new \Zend\Validator\File\MimeType(array('mimeType' => 'application/pdf',
                                                        'message' => 'File is not a PDF.')),
                new \Zend\Validator\File\Size(array('max' => 1048576,
                                                    'message' => 'File is too big.')),
            ));
            $upload->addFilters(array(
                new \Zend\Filter\File\Rename(array('target' => PDF_DIR . sha1(uniqid()))),
            ));
            if ($upload->isValid()) {
                if ($upload->receive()) {
                    $pdf = $this->getService('Model\Pdf');
                    $files = $upload->getFileInfo();
                    if ($pdf->add($form->getData(), $files)) {
                        $this->setFlash(true, 'success');
                        return $this->redirect()->toUrl('add_pdf');
                    }
                }
                throw new MyException('The PDF could not be added due to a system error. We apologize for any inconvenience.') ;
            } else {
                $messages = $upload->getMessages();
                $form->get('pdf')->setMessages($messages);                
            }
        }
        return array('form' => $form);
    }
}
