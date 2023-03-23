<?php

namespace App\Form;

use App\Entity\QuestionNumber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionNumberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('entitled', null, [
                'label' => 'Question',
            ])
            ->add('nbStart', null, [
                'label' => 'Nombre de départ',
            ])
            ->add('nbEnd', null, [
                'label' => 'Nombre de fin',
            ])
            ->add('step', null, [
                'label' => 'Pas',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => QuestionNumber::class,
        ]);
    }
}
