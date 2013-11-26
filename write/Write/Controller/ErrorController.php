<?php
namespace Write\Controller;

class ErrorController extends AbstractController {
    public function indexAction() {
        $error['code']    = '404 Page Not Found!';
        $error['message'] = 'The requested page was not found. Please verify the URL and try again.';
        $this->view->setVar( 'error', $error );
    }
}