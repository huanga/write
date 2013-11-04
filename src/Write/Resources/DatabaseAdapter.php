<?php
namespace Write\Resources;

use Phalcon\Db\Adapter\Pdo\Mysql as PhalconPDOMySQL;

class DatabaseAdapter {
	public function __construct() {
		$configuration = array(
			'host'     => 'localhost',
			'dbname'   => 'write',
			'port'     => 3306,
			'username' => 'root',
			'password' => 'password'
		);
		$this->_instance = new PhalconPDOMySQL( $configuration );
	}
}