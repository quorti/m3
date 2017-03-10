<?php

namespace AppBundle\Controller;

use AppBundle\Form\LessonType;
use AppBundle\Entity\Lesson;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LessonController extends Controller
{
    /**
     * @Route("/lesson/{id}", name="lesson")
     */
    public function displayAction($id = -1)
    {
        $em = $this->getDoctrine()->getManager();
        $lesson = $em->find(Lesson::class, $id);
        if(null != $lesson) {
            $hasPrevious = ($lesson->getPreviousLesson() != null);
            $hasNext = ($lesson->getNextLesson() != null);
            return $this->render('lesson/lesson.html.twig',
                array('id' => $id,
                    'link' => $lesson->getLink(),
                    'name' => $lesson->getName(),
                    'content' => $lesson->getContent(),
                    'previousID' => ($hasPrevious ? $lesson->getPreviousLesson()->getId() : ''),
                    'previousName' => ($hasPrevious ? $lesson->getPreviousLesson()->getName() : ''),
                    'previousText' => ($hasPrevious ? '<--' : ''),
                    'nextID' => ($hasNext ? $lesson->getNextLesson()->getId() : ''),
                    'nextName' => ($hasNext ? $lesson->getNextLesson()->getName() : ''),
                    'nextText' => ($hasNext ? '-->': '')
                ));
        } else {
            $this->addFlash('Error', 'Lesson not found');
            return $this->redirectToRoute('homepage');
        }
    }

    /**
     * @Route("/lessons/new", name="new_lesson")
     */
    public function newAction(Request $request)
    {
        $lesson = new Lesson();

        $form = $this->createForm(LessonType::class, $lesson);
        $form->handleRequest($request);
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($lesson);
            $em->flush();

            $this->addFlash('Success', 'Lesson angelegt');

            //return $this->redirectToRoute('lesson_list', array());
            return $this->redirectToRoute('homepage', array());
        }

        return $this->render('lesson/new_lesson.html.twig', array(
            'mcontent' => '',
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/lessons/list", name="lesson_list")
     */
    public function lessonListAction() {
        $em = $this->getDoctrine()->getManager();
        $lessons = $em->getRepository('AppBundle\Entity\Lesson')->findAll();

        return $this->render('lesson/lessonList.html.twig',
            array('lessons' => $lessons)
        );
    }
}
