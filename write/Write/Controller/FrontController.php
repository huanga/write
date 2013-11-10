<?php
namespace Write\Controller;

use Ciconia\Ciconia;
use Ciconia\Extension\Gfm;

class FrontController extends AbstractController {

	protected function _buildPage( $path ) {
		$mdPath   = $path . '.md';
		$htmlPath = $path . '.html';

		// Verify that the markdown file still exist
		if ( file_exists( $mdPath ) ) {
			$pagebody = '';
			// Check if we already have HTML version
			if ( file_exists( $htmlPath ) ) {
				// If the HTML file is newer than the markdown file, we don't need to rebuild it
				if ( filemtime( $mdPath ) < filemtime( $htmlPath ) ) {
					$pagebody = file_get_contents( $htmlPath );
				}
			}

			if ( $pagebody == '' ) {
				// Build the page
				$md = file_get_contents( $mdPath );
				$pagebody = $this->_renderMarkdown( $md );

				// Attempt to cache the file
				$handle = fopen( $htmlPath, 'w' );
				fwrite( $handle, $pagebody );
			}

			$this->view->setVar( 'pagebody', $pagebody );

		} else {
			$this->view->setVar( 'pagebody', '404 Page not found!' );
		}
	}

	protected function _renderMarkdown( $md ) {
		$ciconia = new Ciconia();
		$ciconia->addExtension(new Gfm\FencedCodeBlockExtension());
		$ciconia->addExtension(new Gfm\TaskListExtension());
		$ciconia->addExtension(new Gfm\InlineStyleExtension());
		$ciconia->addExtension(new Gfm\WhiteSpaceExtension());
		$ciconia->addExtension(new Gfm\TableExtension());

		$rendered = $ciconia->render( $md );

		return $rendered;
	}

	public function getAction() {
		$params = $this->dispatcher->getParams();
		if ( empty( $params ) ) {
			$this->dispatcher->forward( array(
				'action' => 'Homepage'
			) );
		}
		$path     = '/var/www/write/data/' . implode( '/', $params );
		$this->_buildPage( $path );
	}

	public function homepageAction() {
		$this->view->pick( 'Front/get' );
		$this->view->setVar( 'pagebody', 'This is the homepage.' );
	}
}