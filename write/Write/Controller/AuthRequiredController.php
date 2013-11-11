<?php
namespace Write\Controller;

use Write\Model\Db\User;

class AuthRequiredController extends AbstractController
{
    public function initialize()
    {
        $authenticated = false;

        if ($this->session->has('username')) {
            $username = $this->session->get('username');
            $password = $this->session->get('password');

            if (User::authenticate($username, $password)) {
                $authenticated = true;
            }
        }

        if (!$authenticated) {
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: /write/session/new');
        }
    }

}