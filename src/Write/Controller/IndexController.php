<?php
namespace Write\Controller;

use Write\Model\User;

class IndexController extends AbstractController {
	public function IndexAction() {
		$authenticated = false;

		if ( $this->session->has( 'username' ) ) {
			$username = $this->session->get( 'username' );
			$password = $this->session->get( 'password' );

			if ( User::authenticate( $username, $password ) ) {
				$authenticated = true;
			}
		}

		if ( !$authenticated ) {
			header( 'HTTP/1.1 301 Moved Permanently' );
			header( 'Location: /write/session/new' );
			$this->dispatcher->forward( array(
				'controller' => 'session',
				'action'     => 'new'
			) );
		}
	}
}