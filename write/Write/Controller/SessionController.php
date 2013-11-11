<?php
namespace Write\Controller;

class SessionController extends AbstractController
{
    public function indexAction()
    {
        $this->dispatcher->forward(
            array(
                'action' => 'new'
            )
        );
    }

    public function newAction()
    {

    }
}