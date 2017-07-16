<?php

namespace EasyRoom\AppBundle\Form;

use EasyRoom\AppBundle\Repository\DispositionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalleType
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
                    'label'    => 'Disponible',
                    'required' => false
                ))
                ->add('description', TextareaType::class, array(
                    'label'    => 'Description', 'required' => false
                ))
                ->add('lumiereJour', CheckboxType::class, array(
                    'label'    => 'Lumière du jour',
                    'required' => false
                ))
                ->add('handicap', CheckboxType::class, array(
                    'label'    => 'Accès handicapé',
                    'required' => false
                ))
                ->add('file', FileType::class)
                ->add('capaciteRectangle', IntegerType::class, array(
                    'label' => 'Capacité de la disposition "Rectangle"',
                    'required' => false
                ))
                ->add('capaciteConference', IntegerType::class, array(
                    'label' => 'Capacité de la disposition "Conférence"'
                ))
                ->add('capaciteClasse', IntegerType::class, array(
                    'label' => 'Capacité de la disposition "Classe"'
                ))
                ->add('capaciteVide', IntegerType::class, array(
                    'label' => 'Capacité de la disposition "Vide"'
                ))
                ->add('dispositionDefaut', EntityType::class, array(
                    'class'         => 'EasyRoom\AppBundle\Entity\Disposition',
                    'query_builder' => function (DispositionRepository $repository) {
                        return $repository->getAllQueryBuilder();
                    },
                    'choice_label' => 'libelle',
                    'label'        => 'Diposition par défaut'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'EasyRoom\AppBundle\Entity\Salle'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'easyroom_appbundle_salle';
    }

}
