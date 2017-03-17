<?php
/**
 * Created by PhpStorm.
 * User: quorti
 * Date: 10.03.2017
 * Time: 16:40
 */

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    public function __construct()
    {
        parent::__construct();
        // TODO your own logic
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string")
     */
    protected $lastname;

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $googleId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $facebookId;

    /**
     * @return mixed
     */
    public function getGoogleId()
    {
        return $this->googleId;
    }

    /**
     * @param mixed $googleId
     */
    public function setGoogleId($googleId)
    {
        $this->googleId = $googleId;
    }

    /**
     * @return mixed
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param mixed $facebookId
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $email = is_null($email) ? '' : $email;
        parent::setEmail($email);
        $this->setUsername($email);
    }



    /*private $name;
    private $email;
    private $password;
    private $salt;
    private $confirmationToken;*/
}

//    /**
//     * @ORM\Id
//     * @ORM\GeneratedValue(strategy="AUTO")
//     * @ORM\Column(type="integer")
//     */
//    private $id;
//    /**
//     * @ORM\Column(type="string")
//     */
//    private $name;
//    /**
//     * @ORM\Column(type="string")
//     */
//    private $surname;
//    /**
//     * @ORM\Column(type="string")
//     */
//    private $email;
//
//    /**
//     * @ORM\Column(type="string")
//     */
//    private $password;
//
//    /**
//     * @ORM\Column(type="string")
//     */
//    private $salt;
//
//    /**
//     * @return mixed
//     */
//    public function getSalt()
//    {
//        return $this->salt;
//    }
//
//    /**
//     * @param mixed $salt
//     */
//    public function setSalt($salt)
//    {
//        $this->salt = $salt;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getPassword()
//    {
//        return $this->password;
//    }
//
//    /**
//     * @param mixed $password
//     */
//    public function setPassword($password)
//    {
//        $this->password = $password;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getName()
//    {
//        return $this->name;
//    }
//
//    /**
//     * @param mixed $name
//     */
//    public function setName($name)
//    {
//        $this->name = $name;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getSurname()
//    {
//        return $this->surname;
//    }
//
//    /**
//     * @param mixed $surname
//     */
//    public function setSurname($surname)
//    {
//        $this->surname = $surname;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getEmail()
//    {
//        return $this->email;
//    }
//
//    /**
//     * @param mixed $email
//     */
//    public function setEmail($email)
//    {
//        $this->email = $email;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getId()
//    {
//        return $this->id;
//    }
