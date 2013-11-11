<?php
namespace Write\Resources;

use Phalcon\DI\FactoryDefault as PhalconDependencyInjector;

class DependencyInjector extends AbstractResource
{
    public function __construct()
    {
        $this->_instance = new PhalconDependencyInjector();
    }
}