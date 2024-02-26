<?php

namespace App\Form;

use App\Entity\Chaine;
use App\Entity\TypeChaine;
// use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ChaineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom', TextType::class, [
                'label' => '',
                'attr' => [
                    'class' => 'form-control rounded-4'
                ]
            ])
            ->add('Numero', TextType::class, [
                'label' => '',
                'attr' => [
                    'class' => 'form-control rounded-4'
                ]
            ])
            ->add('TypeChaine', EntityType::class, [
                'class' => TypeChaine::class,
                'choice_label' => 'type',
                'attr' => [
                    'class' => 'form-select'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chaine::class,
        ]);
    }
}
