<?php

namespace Application\Model;

use Zend\Db\TableGateway\AbstractTableGateway;

class Favorite extends AbstractTableGateway
{
    public function __construct($adapter, $table='favorite_pages')
    {
        $this->table = $table;
        $this->adapter = $adapter;
    }

    public function add($user_id, $page_id)
    {
        $data = array('user_id' => $user_id,
                      'page_id' => $page_id,
        );
        $fav = $this->select($data);
        if ($fav->count() < 1) {
            return $this->insert($data);
        }
    }

    public function remove($user_id, $page_id)
    {
        $data = array('user_id' => $user_id,
                      'page_id' => $page_id,
        );
        return $this->delete($data);
    }

    public function isFavorite($user_id, $page_id)
    {
        $data = array('user_id' => $user_id,
                      'page_id' => $page_id,
        );
        $row = $this->select($data);
        return $row->count() > 0;
    }

    public function all($user_id)
    {
        return $this->select(function ($select) use ($user_id) {
                    $select->join('pages', 'favorite_pages.page_id=pages.id')
                           ->where(array('favorite_pages.user_id' => $user_id))
                           ->limit(10)
                           ->order('title');
                });
    }
}
