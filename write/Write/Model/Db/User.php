<?php
namespace Write\Model\Db;

use Phalcon\Security as PhalconSecurity;
use Write\Model\AbstractPhalconModel;

class User extends AbstractPhalconModel
{
    protected $hash;
    protected $id;
    protected $picture;
    protected $twitter;
    protected $username;

    public static function authenticate($username, $password)
    {
        /* @var \Write\Model\User $result */
        $result = User::findFirst(
            array(
                'username' => $username,
            )
        );

        if ($result !== false) {
            $security = new PhalconSecurity();
            $userHash = $security->hash($result->getHash() . 'write');
            $sessionHash = $security->hash($security->hash($password) . 'write');

            if ($password == $userHash) {
                // Session hash valid
                $result = true;
            } else {
                if ($sessionHash == $userHash) {
                    // Login hash valid
                    $result = true;
                } else {
                    // Valid username, invalid password
                    $result = false;
                }
            }
        }

        return $result;
    }

    /**
     * @return mixed
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @return mixed
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    public function initialize()
    {
        $this->setSource("user");
    }

    /**
     * @param mixed $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @param mixed $twitter
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
}