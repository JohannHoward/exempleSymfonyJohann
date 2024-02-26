<?php

namespace App\Form;

use App\Entity\Abonnement;
use App\Entity\Categorie;
use App\Entity\Client;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class Abonnement1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Date_debut', DateType::class, [
                'label' => '',
                'attr' => [
                    'class' => 'form-control rounded-4'
                ]
            ])
            ->add('Date_Fin', DateType::class, [
                'label' => '',
                'attr' => [
                    'class' => 'form-control rounded-4'
                ]
            ])
            ->add('Categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'nom',
                'attr' => [
                    'class' => 'form-select'
                ]
            ])
            ->add('Client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'NumCIN',
                'attr' => [
                    'class' => 'form-select'
                ]
                ]);
            // ->add('Actif',CheckboxType::class,[
            //     'required' => false,
            //     'data'=> true,
            //     'attr' => [
            //         'class' => 'form-select','disable'=>true
            //     ]
            // ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Abonnement::class,
        ]);
    }
}
