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
                    'previousID' => ($hasPrevious ? $lesson->getPreviousLesson()->getId() : null),
                    'previousName' => ($hasPrevious ? $lesson->getPreviousLesson()->getName() : null),
                    'previousText' => ($hasPrevious ? '<--' : ''),
                    'nextID' => ($hasNext ? $lesson->getNextLesson()->getId() : null),
                    'nextName' => ($hasNext ? $lesson->getNextLesson()->getName() : null),
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
        if($form->isSubmitted()) {
            if ($form->isValid()) {
                $success = true;

                $em = $this->getDoctrine()->getManager();
                $em->persist($lesson);

                //if previous lesson is set, set the previous' next lesson
                if(null != $lesson->getPreviousLesson()) {
                    $previousLesson = $em->find(Lesson::class, $lesson->getPreviousLesson()->getId());
                    //check if the previous lesson already has a next lesson
                    if(null == $previousLesson->getNextLesson()) {
                        $previousLesson->setNextLesson($lesson);
                    } else {
                        $this->addFlash('Error', 'Der Vorgänger hat bereits einen Nachfolger');
                        $success = false;
                    }
                }

                //if next lesson is set, set the next' previous lesson
                if(null != $lesson->getNextLesson()) {
                    $nextLesson = $em->find(Lesson::class, $lesson->getNextLesson()->getId());
                    //check if the next lesson already has a previous lesson
                    if(null == $nextLesson->getPreviousLesson()) {
                        $nextLesson->setPreviousLesson($lesson);
                    } else {
                        $this->addFlash('Error', 'Der Nachfolger hat bereits einen Vorgänger');
                        $success = false;
                    }
                }

                if($success) {
                    $em->flush();
                    $this->addFlash('Success', 'Übung angelegt');
                    return $this->redirectToRoute('homepage', array());
                } else {
                    //ToDo: show new flash messages
                }
            }
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
