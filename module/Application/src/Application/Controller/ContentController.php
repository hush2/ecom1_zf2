<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Application\Controller\Exception\MyException;

class ContentController extends AbstractActionController
{
    //--------------------------------------------------------------------------
    // Show titles from a category.
    //--------------------------------------------------------------------------
    public function categoryAction()
    {
        $page = $this->getService('Model\Page');
        $data['titles'] = $page->all($this->params('categoryId'));
        return $data;
    }

    //--------------------------------------------------------------------------
    // Show page info.
    //--------------------------------------------------------------------------
    public function pageAction()
    {
        $pageId = $this->params('pageId');
        $page = $this->getService('Model\Page');
        if ($data['page'] = $page->find($pageId)) {
            $auth = $this->getService('Auth');
            if ($auth->hasIdentity() && !$auth->getIdentity()->isExpired) {
                $userId = $auth->getIdentity()->id;
                $favorite = $this->getService('Model\Favorite');
                // Is the page a favorite?
                $data['isFavorite'] = $favorite->isFavorite($userId, $pageId);
                // Add page to 'Viewing History'
                $history = $this->getService('Model\History');
                $history->addPage($userId, $pageId);
            }
        } else {
            $this->getResponse()->setStatusCode(404);
            return;
        }
        return $data;
    }

    //--------------------------------------------------------------------------
    // Show 'Your Viewing History'.
    //--------------------------------------------------------------------------
    public function historyAction()
    {
        $userId = $this->getService('Auth')->getIdentity()->id;
        $history = $this->getService('Model\History');
        $data['pages'] = $history->allPages($userId);
        $data['pdfs'] = $history->allPdfs($userId);
        return $data;
    }

    //--------------------------------------------------------------------------
    // Show list of favorite pages.
    //--------------------------------------------------------------------------
    public function favoritesAction()
    {
        $favorite = $this->getService('Model\Favorite');
        $userId = $this->getService('Auth')->getIdentity()->id;
        return array('titles' => $favorite->all($userId));
    }

    //--------------------------------------------------------------------------
    // Add page to favorites.
    //--------------------------------------------------------------------------
    public function addtofavoritesAction()
    {
        $pageId = $this->params('pageId');
        $userId = $this->getService('Auth')->getIdentity()->id;
        $favorite = $this->getService('Model\Favorite');
        if ($favorite->add($userId, $pageId)) {
            $this->setFlash(true, 'added');
        }
        return $this->redirect()->toRoute('page', array('pageId' => $pageId));
    }


    //--------------------------------------------------------------------------
    // Remove page from favorites.
    //--------------------------------------------------------------------------
    public function removefromfavoritesAction()
    {
        $pageId = $this->params('pageId');
        $userId = $this->getService('Auth')->getIdentity()->id;
        $favorite = $this->getService('Model\Favorite');
        if ($favorite->remove($userId, $pageId)) {
            $this->setFlash(true, 'removed');
        }
        return $this->redirect()->toRoute('page', array('pageId' => $pageId));
    }

    //--------------------------------------------------------------------------
    // Show PDF titles
    //--------------------------------------------------------------------------
    public function pdfsAction()
    {
        $pdfs = $this->getService('Model\Pdf');
        return array('titles' => $pdfs->all());
    }

    //--------------------------------------------------------------------------
    // Download PDF file
    //--------------------------------------------------------------------------
    public function viewpdfAction()
    {
        $pdf = $this->getService('Model\Pdf');
        $pdf = $pdf->find($this->params('pdfId'));
        if ($pdf) {
            $auth = $this->getService('Auth');
            if (!$auth->hasIdentity() || $auth->getIdentity()->isExpired) {
                return array('pdf' => $pdf);
            }
            $history =  $this->getService('Model\History');
            $userId = $auth->getIdentity()->id;
            $history->addPdf($userId, $pdf->id);

            return $this->sendFile($pdf->file_name, PDF_DIR . $pdf->tmp_name);
        }
        throw new MyException('...');
    }

}
