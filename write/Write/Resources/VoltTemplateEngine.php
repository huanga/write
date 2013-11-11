<?php
namespace Write\Resources;

use Phalcon\Mvc\View\Engine\Volt as PhalconVoltEngine;

class VoltTemplateEngine extends AbstractResource
{
    public function __construct($view, DependencyInjector $di)
    {
        $this->_instance = new PhalconVoltEngine($view, $di);
        $this->_instance->setOptions(
            array(
                'compiledPath' => './cache/volt/'
            )
        );
    }

}