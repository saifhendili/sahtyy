<?php

namespace App\Form;

use App\Entity\FormAide;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormAideType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('img')
            ->add('textpub')
            ->add('quantit')
            ->add('categories')
            ->add('ville', ChoiceType::class, [
                'choices'  => [
                    
                    'Ariana' => "Ariana",
                    'Béja' => "Béja",
                    'Ben Arous' => "Ben Arous",
                    'Bizerte' => "Bizerte",
                    'Gabès' => "Gabès",
                    'Gafsa' => "Gafsa",
                    'Jendouba' => "Jendouba",
                    'Kairouan' => "Kairouan",
                    'Kasserine' => "Kasserine",
                    'Kébili' => "Kébili",
                    'Kef' => "Kef",
                    'Mahdia' => "Mahdia",
                    'Manouba' => "Manouba",
                    'Médenine' => "Médenine",
                    'Monastir' => "Monastir",
                    'Sfax' => "Sfax",
                    'Sidi Bouzid' => "Sidi Bouzid",
                    'Siliana' => "Siliana",
                    'Sousse' => "Sousse",
                    'Tataouine' => "Tataouine",
                    'Tozeur' => "Tozeur",
                    'Tunis' => "Tunis",
                    'Zaghouan' => "Zaghouan",

                ],
            ]);
            
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FormAide::class,
        ]);
    }
}
