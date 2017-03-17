<?php
/**
 * Created by PhpStorm.
 * User: yorrickschwappacher
 * Date: 17.10.16
 * Time: 17:46
 */

namespace AppBundle\Service;


use Doctrine\ORM\EntityManager;

class NavigationService
{

    private $em;

    /**
     * NavigationService constructor.
     * @param $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    public function getNavigationElements()
    {
        //$lessons = $this->em->getRepository('AppBundle:Lesson')->findAll();
        $lessons = $this->em->getRepository('AppBundle:Lesson')->findBy(array(), array(
            'sortID' => 'asc',
            'name' => 'asc',
            'id' => 'asc'));
        return $lessons;
    }

    public function __toString()
    {
        return 'NavigationService';
    }
}