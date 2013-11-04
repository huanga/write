<?php
namespace Write\Controller;

use Phalcon\Mvc\Controller;

class SessionController extends Controller {
	public function IndexAction() {
		$this->dispatcher->forward(array(
			'action' => 'new'
		));
	}

	public function NewAction() {

	}
}