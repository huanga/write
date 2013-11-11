<?php
namespace Write\Resources;

use Phalcon\Mvc\Dispatcher as PhalconDispatcher;

class Dispatcher extends AbstractResource
{
    public function __construct(DependencyInjector $di)
    {
        $this->_instance = new PhalconDispatcher();
        $this->_instance->setDefaultNameSpace('Write\Controller');
        $this->_instance->setDI($di);
    }
}