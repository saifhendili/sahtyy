<?php

namespace App\Form;

use App\Entity\User;
use mysql_xdevapi\TableSelect;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom')
        ->add('prenom')
       
        ->add('adress')
        ->add('type', ChoiceType::class, [
            'choices'  => [
                'Patient' => "patient",
                'Medecin' => "médecin",
                'Pharmacie' => "pharmacie",
            ]
        ])
        
         ->add('email')
         ->add('adress', ChoiceType::class, [
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
        ])


   
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
