<?php
namespace Write\Resources;

use Phalcon\Mvc\View as PhalconViewManager;

class ViewManager extends AbstractResource {
	public function __construct( DependencyInjector $di ) {
		$this->_instance = new PhalconViewManager();
		$this->_instance->setViewsDir( '../src/Write/View/' );
		$this->_instance->registerEngines(array(
			'.volt' => 'Write\Resources\VoltTemplateEngine'
		));
		$this->_instance->setDI( $di );
	}
}