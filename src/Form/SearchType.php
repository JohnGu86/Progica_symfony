<?php

namespace App\Form;

use App\Entity\Departement;
use App\Entity\EquipementExterieur;
use App\Entity\EquipementInterieur;
use App\Entity\Region;
use App\Entity\Service;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('region', EntityType::class, [
                'label' => 'Région:',
                'class' => Region::class,
                'required' => false,
                ])
            ->add('departement', EntityType::class, [
                'label' => 'Département:',
                'class' => Departement::class,
                'required' => false,
                ])
            ->add('ville', EntityType::class, [
                'label' => 'Ville:',
                'class' => Ville::class,
                'required' => false,
                ])
            ->add('equipementInterieur', EntityType::class, [
                'label' => 'Equipement intérieur:',
                'class' => EquipementInterieur::class,
                'required' => false,
                'multiple' => true,
                'expanded' => true
                ])
            ->add('equipementExterieur', EntityType::class, [
                'label' => 'Equipement extérieur:',
                'class' => EquipementExterieur::class,
                'required' => false,
                'multiple' => true,
                'expanded' => true
                ])
            ->add('service', EntityType::class, [
                'label' => 'Service:',
                'class' => Service::class,
                'required' => false,
                'multiple' => true,
                'expanded' => true
                ])
            ->add('filtrer', SubmitType::class, [
                'label' => 'Filtrer'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
