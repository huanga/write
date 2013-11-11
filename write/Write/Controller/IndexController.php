<?php
namespace Write\Controller;

class IndexController extends AuthRequiredController
{
    public function indexAction()
    {
        $this->dispatcher->forward(
            array(
                'controller' => 'Index',
                'action' => 'Dashboard'
            )
        );
    }

    public function dashboardAction()
    {
    }
}