<?php
namespace Application\Model;

use Zend\Db\TableGateway\AbstractTableGateway;

class Pdf extends AbstractTableGateway
{
    public function __construct($adapter, $table='pdfs')
    {
        $this->table = $table;
        $this->adapter = $adapter;
    }

    public function all()
    {
        $select = function ($select) {
            $select->order('date_created desc');
        };
        return $this->select($select);
    }

    public function find($pdf_name)
    {
        $result = $this->select(array('tmp_name' => $pdf_name));
        if ($result->count() > 0) {
            return $result->current();
        }
    }

    public function add($form, $pdf)
    {
        $data = array(
            'tmp_name'    => $pdf['pdf']['name'],
            'title'       => strip_tags($form['title']),
            'description' => strip_tags($form['description']),
            'file_name'   => $_FILES['pdf']['name'],
            'size'        => round($pdf['pdf']['size'] / 1024),
        );
        try {
            return $this->insert($data);
        } catch (Exception $e) {}
    }

}
