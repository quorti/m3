<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LessonType extends AbstractType
{
    //TODO adding a view transformer that transforms a(n) string to an instance of  Symfony\Component\HttpFoundation\File\File
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array('label' => 'Name'))
            ->add('navName', TextType::class, array('label' => 'Navigation Name'))
            ->add('link', TextType::class, array(
                'label' => 'YouTube Link',
                'required' => false
            ))
            ->add('shortDesc', TextareaType::class, array('label' => 'Kurzbeschreibung'))
            ->add('sortID', IntegerType::class, array('label' => 'Sortierungs ID'))
            ->add('content', TextareaType::class, array('label' => 'Inhalt'))
            ->add('previousLesson', EntityType::class, array(
                'label' => 'Vorgänger',
                'class' => 'AppBundle\Entity\Lesson',
                'expanded' => false,
                'multiple' => false,
                'required' => false,
                'placeholder' => '--'
            ))
            ->add('overwritePreviousNext', CheckboxType::class, array(
                'label' => 'Vorhandenen Nachfolger im Vorgänger überschreiben',
                'required' => false,
                'mapped' => false
            ))
            ->add('nextLesson', EntityType::class, array(
                'label' => 'Nachfolger',
                'class' => 'AppBundle\Entity\Lesson',
                'expanded' => false,
                'multiple' => false,
                'required' => false,
                'placeholder' => '--'
            ))
            ->add('overwriteNextPrevious', CheckboxType::class, array(
                'label' => 'Vorhandenen Vorgänger im Nachfolger überschreiben',
                'required' => false,
                'mapped' => false
            ))
            ->add('file', FileType::class, array(
                    'label' => 'Datei',
                    'required' => false
                )
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
           'data_class' => 'AppBundle\Entity\Lesson'
        ));
    }

    public function getName()
    {
        return 'app_bundle_lesson_type';
    }
}
