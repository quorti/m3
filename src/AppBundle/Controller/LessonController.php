<?php

namespace AppBundle\Controller;

use AppBundle\Entity\File;
use AppBundle\Form\LessonFileType;
use AppBundle\Form\LessonType;
use AppBundle\Entity\Lesson;
use AppBundle\Service\FileUploadService;
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
            return $this->render('lesson/lesson.html.twig', array(
                'lesson' => $lesson,
                'previousID' => ($hasPrevious ? $lesson->getPreviousLesson()->getId() : null),
                'previousName' => ($hasPrevious ? $lesson->getPreviousLesson()->getName() : null),
                'nextID' => ($hasNext ? $lesson->getNextLesson()->getId() : null),
                'nextName' => ($hasNext ? $lesson->getNextLesson()->getName() : null),
            ));
           /* return $this->render('lesson/lesson.html.twig',
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
                ));*/
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

                //parse the youtube links
                $lesson->setLink($this->parseYoutubeLink($lesson->getLink()));

                $em = $this->getDoctrine()->getManager();
                $em->persist($lesson);

                //if previous lesson is set, set the previous' next lesson
                if(null != $lesson->getPreviousLesson()) {
                    $previousLesson = $em->find(Lesson::class, $lesson->getPreviousLesson()->getId());
                    //check if the previous lesson already has a next lesson
                    if(null == $previousLesson->getNextLesson() || $form->get('overwritePreviousNext')->getData()) {
                        $previousLesson->setNextLesson($lesson);
                    } else {
                        $this->addFlash('previousError', 'Der Vorgänger hat bereits einen Nachfolger');
                        $success = false;
                    }
                }

                //if next lesson is set, set the next' previous lesson
                if(null != $lesson->getNextLesson()) {
                    $nextLesson = $em->find(Lesson::class, $lesson->getNextLesson()->getId());
                    //check if the next lesson already has a previous lesson
                    if(null == $nextLesson->getPreviousLesson() || $form->get('overwriteNextPrevious')->getData()) {
                        $nextLesson->setPreviousLesson($lesson);
                    } else {
                        $this->addFlash('nextError', 'Der Nachfolger hat bereits einen Vorgänger');
                        $success = false;
                    }
                }

                if($success) {
                    $em->flush();

                    if(null != $lesson->getFile()) {
                        $folder = "lessons/" . $lesson->getId();
                        $fileUploader = new FileUploadService($folder);
                        $file = $folder . "/" . $fileUploader->upload($lesson->getFile());
                        $lesson->setFile($file);

                        $em->merge($lesson);
                        $em->flush();
                    }


                    $this->addFlash('Success', 'Übung angelegt ');
                    return $this->redirectToRoute('homepage', array());
                }
            }
        }

        return $this->render('lesson/new_lesson.html.twig', array(
            'mcontent' => '',
            'form' => $form->createView()
        ));
    }

    private function parseYoutubeLink($link) {
        if(strpos($link, 'youtu.be')) {
            //https://youtu.be/G4lQ56pWwWc
            return explode('be/', $link)[1];
        } else if(strpos($link, 'watch?')) {
            //https://www.youtube.com/watch?v=G4lQ56pWwWc
            return explode('watch?v=', $link)[1];
        }

        return $link;
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

    /**
     * @Route("/lessons/edit/{id}", name="edit_lesson")
     */
    public function editAction(Request $request, $id = -1) {
        $em = $this->getDoctrine()->getManager();
        $lesson = $em->find(Lesson::class, $id);
        $form = $this->createForm(LessonType::class, $lesson);
        $form->handleRequest($request);

        if(null == $lesson) {
            $this->addFlash('edit', 'Übung wurde nicht gefunden');
            return $this->redirectToRoute("lesson_list");
        }

        if($form->isSubmitted() && $form->isValid()) {
            $em->merge($lesson);
            $em->flush();
            $this->addFlash('edit', 'Bearbeitung erfolgreich');
            return $this->redirectToRoute("lesson_list");
        }

        return $this->render('lesson/new_lesson.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
