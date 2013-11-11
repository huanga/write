<?php
namespace Write\Resources;

use Phalcon\Mvc\Router as PhalconRouter;

class Router extends AbstractResource
{
    public function __construct()
    {
        $this->_instance = new PhalconRouter();
        $this->_instance->add(
            '/session/:action',
            array(
                'controller' => 'session',
                'action' => 1
            )
        );
    }
}