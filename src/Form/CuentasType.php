<?php

namespace App\Form;

use App\Entity\Cuentas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
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
                    'label' => 'GAME'
                ]
            )
            ->add('juego', ChoiceType::class, [
                'label' => 'GAME',
                'choices' => [
                    'League Of Legends' => 'LeagueOfLegends',
                    'Fortnite' => 'Fortnite',
                ],
            ])
            ->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
                $form = $event->getForm();
                $entity = $form->getData();
                if ($entity instanceof Cuentas && $entity->getNombre() && $entity->getJuego()) {
                    $enlace = $this->construirEnlace($entity->getNombre(), $entity->getJuego());

                    $entity->setEnlace($enlace);
                }
            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cuentas::class,
        ]);
    }
    private function construirEnlace(string $nombre, string $juego): string
    {
        if ($juego == "LeagueOfLegends") {
            $nombre = explode("#", $nombre);
            $ruta = $this->router->generate('app_league_of_legends_summonername', [
                'name' => $nombre[0],
                'tag' => $nombre[1],
            ]);
        } else {
            $ruta = $this->router->generate('app_fortnite_stats', [
                'name' => $nombre,
            ]);
        }
        return $ruta;
    }
}
