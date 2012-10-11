<?php

namespace Application\Model;

use Zend\Db\TableGateway\AbstractTableGateway,
    Zend\Db\Sql\Expression;

class User extends AbstractTableGateway
{
    public function __construct($adapter, $table='users')
    {
        $this->table = $table;
        $this->adapter = $adapter;
    }

    public function add($data)
    {
        $user = array(
            'username'     => $data['username'],
            'email'        => $data['email'],
            'pass'         => $this->hash($data['pass']),
            'first_name'   => $data['first_name'],
            'last_name'    => $data['last_name'],
            'date_expires' => new Expression('ADDDATE(NOW(), INTERVAL 1 MONTH)'),
        );
        try {
            return $this->insert($user);
        } catch (\Exception $e) { }
    }

   public function changePassword($id, $password)
    {
        $data = array(
            'pass' => $this->hash($password),
            'date_modified' => new Expression('NOW()'),
        );
        try {
            return $this->update($data, array('id' => $id));
        } catch (\Exception $e) { }
    }

    public function createNewPassword($email)
    {
        $new_password = substr(md5(uniqid(rand(), true)), 10, 15);
        $data = array(
            'pass' => $this->hash($new_password),
            'date_modified' => new Expression('NOW()'),
        );
        try {
            $this->update($data, array('email' => $email));
            return $new_password;
        } catch (\Exception $e) { }
    }

    public function hash($value)
    {
        return md5($value);
    }

}
