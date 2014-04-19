<?php
namespace Write\Resources;

use Phalcon\Db\Adapter\Pdo\Mysql as PhalconPDOMySQL;

class DatabaseAdapter extends GenericPhalconResource
{
    public function __construct()
    {
        // TODO: Refactor this to use Phalcon\Config via injection
        $configuration = array(
            'host' => 'localhost',
            'dbname' => 'write',
            'port' => 3306,
            'username' => 'root',
            'password' => 'password'
        );
        $this->_instance = new PhalconPDOMySQL($configuration);
    }
}