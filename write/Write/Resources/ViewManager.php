<?php
namespace Write\Resources;

use Phalcon\Mvc\View as PhalconViewManager;

class ViewManager extends GenericPhalconResource
{
    public function __construct(DependencyInjector $di)
    {
        $this->_instance = new PhalconViewManager();
        $this->_instance->setViewsDir('./Write/View/');
        $this->_instance->registerEngines(
            array(
                '.volt' => 'Write\Resources\VoltTemplateEngine'
            )
        );
        $this->setDI($di);
    }
}