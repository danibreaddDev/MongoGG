<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email' ,TextType::class,
            [
                'label' => 'User',
                'attr' => ['class' => 'mt-2 mb-2 ms-5 text-white text-center'],
            ]
            )
            ->add('roles',ChoiceType::class, [
                'label' => 'Roles',
                'choices' => [
                    'ROLE_ADMIN' => 'ROLE_ADMIN',
                    'ROLE_USER' => 'ROLE_USER',
                    
                ],
                'multiple' => true, 
                'expanded' => true, 
                'attr' => ['class' => 'mt-2 mb-2 text-white text-center'],
            ])
            ->add('password',TextType::class,
            [
                'label' => 'Password',
                'attr' => ['class' => 'mt-2 mb-2 ms-5 text-white text-center'],
            ]
            );
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
