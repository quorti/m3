<?php
/**
 * Created by PhpStorm.
 * User: yorrickschwappacher
 * Date: 18.10.16
 * Time: 13:19
 */

namespace AppBundle\Security;


use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserWebservice implements UserInterface, EquatableInterface
{

    private $username;
    private $password;
    private $salt;
    private $roles;

    /**
     * UserSecurity constructor.
     * @param $username
     * @param $password
     * @param $salt
     * @param $roles
     */
    public function __construct($username, $password, $salt, $roles)
    {
        $this->username = $username;
        $this->password = $password;
        $this->salt = $salt;
        $this->roles = $roles;
    }

    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof UserWebservice) {
            return false;
        }

        if ($this->password !== $user->getPassword()) {
            return false;
        }

        if ($this->salt !== $user->getSalt()) {
            return false;
        }

        if ($this->username !== $user->getUsername()) {
            return false;
        }

        return true;
    }

    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

}