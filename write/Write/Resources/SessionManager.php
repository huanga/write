<?php
namespace Write\Resources;

use Phalcon\Session\Adapter\Files as PhalconSessionAdapter;

class SessionManager extends GenericPhalconResource
{
    public function __construct()
    {
        $this->_instance = new PhalconSessionAdapter();
        $this->_instance->start();
    }
}