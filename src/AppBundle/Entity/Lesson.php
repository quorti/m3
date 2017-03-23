<?php
/**
 * Created by PhpStorm.
 * User: yorrickschwappacher
 * Date: 14.10.16
 * Time: 00:41
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LessonRepository")
 * @ORM\Table(name="lesson")
 */
class Lesson
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $navName;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="integer")
     */
    private $sortID;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Lesson", inversedBy="nextLesson")
     * @ORM\JoinColumn(name="previous_id", referencedColumnName="id", nullable=true)
     */
    private $previousLesson;


    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Lesson", mappedBy="previousLesson")
     * @ORM\JoinColumn(name="next_id", referencedColumnName="id", nullable=true)
     */
    private $nextLesson;

    /**
     * @return mixed
     */
    public function getPreviousLesson()
    {
        return $this->previousLesson;
    }

    /**
     * @param mixed $nextLesson
     */
    public function setNextLesson($nextLesson)
    {
        $this->nextLesson = $nextLesson;
    }

    /**
     * @param mixed $previousLesson
     */
    public function setPreviousLesson($previousLesson)
    {
        $this->previousLesson = $previousLesson;
    }

    /**
     * @return mixed
     */
    public function getNextLesson()
    {
        return $this->nextLesson;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    /*! TODO use other TABLE !*/
    private $file;

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
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getNavName()
    {
        return $this->navName;
    }

    /**
     * @param mixed $navName
     */
    public function setNavName($navName)
    {
        $this->navName = $navName;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getSortID()
    {
        return $this->sortID;
    }

    /**
     * @param mixed $sortID
     */
    public function setSortID($sortID)
    {
        $this->sortID = $sortID;
    }

    /**
     * @return mixed
     */
    public function getShortDesc()
    {
        return $this->shortDesc;
    }

    /**
     * @param mixed $shortDesc
     */
    public function setShortDesc($shortDesc)
    {
        $this->shortDesc = $shortDesc;
    }

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $shortDesc;

    public function __toString()
    {
        return $this->name;
    }
}