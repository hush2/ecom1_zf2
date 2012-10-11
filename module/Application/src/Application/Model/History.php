<?php

namespace Application\Model;

use Zend\Db\TableGateway\AbstractTableGateway,
    Zend\Db\Sql\Expression;

class History extends AbstractTableGateway
{
    public function __construct($adapter, $table='history')
    {
        $this->table = $table;
        $this->adapter = $adapter;
    }

    public function addPage($userId, $page_id)
    {
        $data = array('user_id' => $userId,
                      'page_id' => $page_id,
                      'type' => 'page',
        );
        try {
            return $this->insert($data);
        } catch (Exception $e) {}
    }

    public function addPdf($userId, $pdf_id)
    {
        $data = array('user_id' => $userId,
                      'pdf_id'  => $pdf_id,
                      'type' => 'pdf',
        );
        try {
            return $this->insert($data);
        } catch (Exception $e) {}
    }

    public function allPages($userId)
    {
        $select = function ($select) use ($userId) {
            $select->join('pages', 'history.page_id=pages.id', array('id', 'title', 'description'))
                   ->where(array('history.user_id' => $userId))
                   ->where("history.type='page'")
                   ->group('history.page_id')
                   ->limit(4)
                   ->order('history.date_created desc')
                   ->columns(array('date' => new Expression('DATE_FORMAT(history.date_created, "%M %d, %Y")')), false);
        };
        return $this->select($select);
    }

    public function allPdfs($userId)
    {
        $select = function ($select) use ($userId) {
            $select->join('pdfs', 'history.pdf_id=pdfs.id', array('id', 'title', 'description'))
                   ->where(array('history.user_id' => $userId))
                   ->where("history.type='pdf'")
                   ->group('history.pdf_id')
                   ->limit(4)
                   ->order('history.date_created desc')
                   ->columns(array('date' => new Expression('DATE_FORMAT(history.date_created, "%M %d, %Y")')), false);
        };
        return $this->select($select);
    }

    public function mostPopular()
    {
        $select = function ($select) {
            $select->join('pages', 'history.page_id=pages.id', array('id', 'title'))
                   ->where("history.type='page'")
                   ->group('history.page_id')
                   ->limit(6)
                   ->order('n desc')
                   ->columns(array('n' => new Expression('COUNT(history.id)')), false);
        };
        return $this->select($select);
    }
}
