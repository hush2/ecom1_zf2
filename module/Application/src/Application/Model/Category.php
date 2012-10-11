<?php

namespace Application\Model;

use Zend\Db\TableGateway\AbstractTableGateway;

class Category extends AbstractTableGateway
{
    public function __construct($adapter, $table='categories')
    {
        $this->table = $table;
        $this->adapter = $adapter;
    }

    public function all()
    {
        $select = function($select) {
            $select->order('category asc');
        };
        return $this->select($select);
    }
}
