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
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
