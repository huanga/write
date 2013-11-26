<?php
namespace Write\Resources;

use Phalcon\Error\Handler as PhalconErrorHandler;
use Phalcon\Mvc\Application as PhalconApplication;

class Application extends AbstractResource
{
    public function __construct(DependencyInjector $di)
    {
        $this->_instance = new PhalconApplication($di);

        PhalconErrorHandler::register();
    }
}