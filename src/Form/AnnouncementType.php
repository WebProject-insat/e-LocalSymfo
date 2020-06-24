<?php

namespace App\Form;

use App\Entity\Announcement;
use App\Entity\City;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnouncementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roomNb')
            ->add('surface')
            ->add('price')
            ->add('furnished')
            ->add('AvailabilityDate')
            ->add('Smoker')
            ->add('maxRoomates')
            ->add('balcon')
            ->add('garden')
            ->add('garage')
            ->add('images' , FileType::class , [
                'required' => false

            ])
            ->add('locatedAt' , EntityType::class,[
                'class' => City::class,
                'choice_label' => 'name'
            ])
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Announcement::class,
        ]);
    }
}
