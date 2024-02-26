<?php

namespace App\Form;

use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class CategorieType extends AbstractType
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
            ->add('NombreChaine', NumberType::class, [
                'label' => '',
                'attr' => [
                    'class' => 'form-control rounded-4'
                ]
            ])
            ->add('Prix', NumberType::class, [
                'label' => '',
                'attr' => [
                    'class' => 'form-control rounded-4'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
