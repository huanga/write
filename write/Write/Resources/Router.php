<?php
namespace Write\Resources;

use Phalcon\Mvc\Router as PhalconRouter;
use Phalcon\Mvc\RouterInterface;

class Router extends GenericPhalconResource implements RouterInterface
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