<?php
/**
 * Created by PhpStorm.
 * User: quorti
 * Date: 14.03.2017
 * Time: 14:19
 */

namespace AppBundle\Service;


use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;

class OAuthUserProviderService implements OAuthAwareUserProviderInterface
{
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        // TODO: Implement loadUserByOAuthUserResponse() method.
        fprintf("wtf");
    }

}