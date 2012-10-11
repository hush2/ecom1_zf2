<?php
namespace Application\Model;

use Zend\Db\TableGateway\AbstractTableGateway;

class Page extends AbstractTableGateway
{
    public function __construct($adapter, $table='pages')
    {
        $this->table = $table;
        $this->adapter = $adapter;
    }

    public function all($id)
    {
        return $this->select(function ($select) use ($id) {
                  $select->where(array('category_id' => $id))
                         ->order('date_created desc');
                });
    }

    public function find($id)
    {
        $page = $this->select(array('id' => $id));
        if ($page->count()) {
            return $page->current();
        }
    }


    public function add($form)
    {
        $allowed = '<div><p><span><br><a><img><h1><h2><h3><h4><ul><ol><li><blockquote><b><strong><em><i><u><strike><sub><sup><font><hr>';
        $data = array(
            'category_id' => $form['categoryId'],
            'title'       => strip_tags($form['title']),
            'description' => strip_tags($form['description']),
            'content'     => strip_tags($form['content'], $allowed),
        );
        try {
            return $this->insert($data);
        } catch (Exception $e) {}
    }
}
