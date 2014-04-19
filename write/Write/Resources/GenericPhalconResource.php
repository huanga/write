<?php
namespace Write\Resources;

class GenericPhalconResource extends AbstractResource {
    /**
     * @return mixed                The underlying instance
     */
    public function getInstance() {
        return $this->_instance;
    }

    public function setDI(DependencyInjector $di) {
        $this->_instance->setDI($di->getInstance());
    }
} 