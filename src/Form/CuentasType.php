<?php

namespace App\Form;

use App\Entity\Cuentas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\FormEvent;

class CuentasType extends AbstractType
{
    private $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'nombre',
                TextType::class,
                [
                    'label' => 'NAME',
                    'attr' => ['class' => 'mt-2 mb-2 ms-5 text-center'],
                    
                ]
            )
            ->add(
                'tag',
                TextType::class,
                [
                    'label' => 'TAG',
                    'attr' => ['class' => 'mt-2 mb-2 ms-5 text-center'],
                    'required'=>false,
                ]
            )
            ->add('juego', ChoiceType::class, [
                'label' => 'GAME',
                'choices' => [
                    'League Of Legends' => 'LeagueOfLegends',
                    'Fortnite' => 'Fortnite',
                ],
                'attr' => ['class' => 'mt-2 mb-2 ms-5 text-center'],

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cuentas::class,
        ]);
    }
}
