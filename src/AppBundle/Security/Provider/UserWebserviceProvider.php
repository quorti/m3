<?php
/**
 * Created by PhpStorm.
 * User: yorrickschwappacher
 * Date: 18.10.16
 * Time: 15:14
 */

namespace AppBundle\Security\Provider;


use AppBundle\Security\UserWebservice;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserWebserviceProvider implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        // TODO: make a call to your webservice here
        $userData = array();
        // pretend it returns an array on success, false if there is no user

        if ($userData) {
            $password = '...';

            // ...

            return new UserWebservice($username, $password, $salt, $roles);
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof UserWebservice) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class == 'AppBundle\Security\Webservice\UserWebservice';
    }

}