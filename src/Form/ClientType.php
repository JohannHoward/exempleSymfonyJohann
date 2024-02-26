<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NumCIN', TextType::class, [
                'label' => '',
                'attr' => [
                    'class' => 'form-control rounded-4'
                ]
            ])
            ->add('Nom', TextType::class, [
                'label' => '',
                'attr' => [
                    'class' => 'form-control rounded-4'
                ]
            ])
            ->add('Prenom', TextType::class, [
                'label' => '',
                'attr' => [
                    'class' => 'form-control rounded-4'
                ]
            ])
            ->add('Telephone', TextType::class, [
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
            'data_class' => Client::class,
        ]);
    }
}
