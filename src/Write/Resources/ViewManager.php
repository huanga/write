<?php
namespace Write\Resources;

use Phalcon\Mvc\View as PhalconViewManager;

class ViewManager extends AbstractResource {
	public function __construct() {
		$this->_instance = new PhalconViewManager();
		$this->	_instance->setViewsDir( '../src/Write/View' );
	}
}