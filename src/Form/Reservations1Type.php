<?php

namespace App\Form;

use App\Entity\Films;
use App\Entity\Reservations;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Reservations1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('film', EntityType::class, [
                'class' => Films::class,
                'choice_label' => 'titre', // Assuming 'titre' is the property to display in the select field
                'placeholder' => 'Choose a film', // Optional placeholder text
            ])
            ->add('datereservation')
            ->add('heurereservation')
            ->add('nombreplacesdisponibles')
            ->add('idutilisateur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservations::class,
        ]);
    }
}
