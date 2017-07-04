<?php

namespace EasyRoom\AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipementType
        extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('libelle', TextType::class, array(
                    'label' => 'Libellé'
                ))
                ->add('disponible', CheckboxType::class, array(
                    'label' => 'Disponible',
                    'required' => false
                ))
                ->add('reference', TextType::class, array(
                    'label'    => 'Référence', 'required' => false
                ))
                ->add('description', TextareaType::class, array(
                    'label'    => 'Description', 'required' => false
                ))
                ->add('salle', EntityType::class, array(
                    'label' => 'Salle liée',
                    'class' => 'EasyRoom\AppBundle\Entity\Salle',
                    'choice_label' => 'libelle',
                    'required' => false
                ))
                ->add('typeEquipement', EntityType::class, array(
                    'label' => 'Type',
                    'class' => 'EasyRoom\AppBundle\Entity\TypeEquipement',
                    'choice_label' => 'libelle'
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'EasyRoom\AppBundle\Entity\Equipement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'easyroom_appbundle_equipement';
    }

}
