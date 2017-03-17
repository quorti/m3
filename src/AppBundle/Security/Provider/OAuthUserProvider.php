<?php
/**
 * Created by PhpStorm.
 * User: quorti
 * Date: 16.03.2017
 * Time: 16:41
 */

namespace AppBundle\Security\Provider;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserChecker;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * Class OAuthUserProvider
 * @package AppBundle\Security\Provider
 */
class OAuthUserProvider extends BaseClass
{

    protected $properties = array(
        'identifier' => 'id',
        'google' => 'id',
        'facebook' => 'id',
    );

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $socialID = $response->getUsername();
        $user = $this->userManager->findUserBy(array($this->getProperty($response)=>$socialID));
        $email = $response->getEmail();
        //check if the user already has the corresponding social account
        if (null === $user) {
            //check if the user has a normal account
            //$user = $this->userManager->findUserByEmail($email);
            $user = $this->userManager->findUserByUsername($email);

            if (null === $user || !$user instanceof UserInterface) {
                //if the user does not have a normal account, set it up:
                $user = $this->userManager->createUser();
                $user->setPlainPassword(md5(uniqid()));
            }

            //update the user if its already
            $user->setUsername($email);
            $user->setEmail($email);
            $user->setEnabled(true);
            $user->setFirstname($response->getFirstName());
            $user->setLastname($response->getLastName());

            //then set its corresponding social id
            $service = $response->getResourceOwner()->getName();
            switch ($service) {
                case 'google':
                    $user->setGoogleID($socialID);
                    break;
                case 'facebook':
                    $user->setFacebookID($socialID);
                    break;
            }
            $this->userManager->updateUser($user);
        } else {
            //and then login the user
            $checker = new UserChecker();
            $checker->checkPreAuth($user);
        }

        return $user;
    }
}