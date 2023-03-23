<?php

namespace App\Form;

use App\Entity\QuestionMCQMultiple;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class QuestionMCQMultipleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('entitled', null, [
                'label' => 'Question',
            ])
            ->add('minNumberAnswer', null, [
                'label' => 'Nombre de réponses minimum',
            ])
            ->add('maxNumberAnswer', null, [
                'label' => 'Nombre de réponses maximum',
            ])
            ->add('answers', CollectionType::class, [
                'label' => 'Réponses',
                'entry_type' => AnswerType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => QuestionMCQMultiple::class,
        ]);
    }
}
