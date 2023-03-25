<?php

namespace App\Form;

use App\Entity\Statistic;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class StatisticType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', null, [
            'label' => 'Titre',
            'attr' => [
                'placeholder' => 'Titre de la statistique',
            ],
        ])
        ->add('description', TextareaType::class, [
            'label' => 'Description',
            'attr' => [
                'placeholder' => 'Description de la statistique',
            ],
        ])
        ->add('type', ChoiceType::class, [
            'label' => false,
            'choices' => [
                'Nombre' => 'nombre',
                'Diagramme en ligne' => 'ligne',
                'Diagramme en barre' => 'barre',
                'Camembert' => 'camembert',
            ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Statistic::class,
        ]);
    }
}
