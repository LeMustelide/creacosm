<?php

namespace App\Form;

use App\Entity\QuestionNumber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
            ->add('nbStart', NumberType::class, [
                'label' => 'Nombre de départ',
            ])
            ->add('nbEnd', NumberType::class, [
                'label' => 'Nombre de fin',
            ])
            ->add('step', NumberType::class, [
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
