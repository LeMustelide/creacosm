<?php

namespace App\Form;

use App\Entity\QuestionText;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionTextType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('entitled', null, [
                'label' => 'Question',
            ])
            ->add('minCharacterLimit', null, [
                'label' => 'Nombre de caractères minimum',
            ])
            ->add('maxCharacterLimit', null, [
                'label' => 'Nombre de caractères maximum',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => QuestionText::class,
        ]);
    }
}
