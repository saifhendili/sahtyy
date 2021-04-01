<?php

namespace App\Form;

use App\Entity\Pharmacies;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PharmaciesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Gouvernorat')
            ->add('Ville')
            ->add('Adresse')
            ->add('NomPharmacie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pharmacies::class,
        ]);
    }
}
