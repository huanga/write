<?php
namespace Write\Controller;

class SessionController extends AbstractController {
	public function IndexAction() {
		$this->dispatcher->forward(array(
			'action' => 'new'
		));
	}

	public function NewAction() {

	}
}