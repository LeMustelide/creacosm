<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('entitled')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Question à choix multiple' => 'Choix multiple',
                    'Question à choix unique' => 'Choix unique',
                    'Question à réponse ouverte' => 'Texte',
                    'Question à nombre' => 'Nombre',
                ],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
