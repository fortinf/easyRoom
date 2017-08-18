<?php

namespace EasyRoom\AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType
        extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('libelle', TextType::class, array(
                    'label' => 'Libellé'
                ))
                ->add('salle', EntityType::class, array(
                    'label'        => 'Salle à réserver',
                    'class'        => 'EasyRoom\AppBundle\Entity\Salle',
                    'choice_label' => 'libelle',
                ))
                ->add('utilisateurs', EntityType::class, array(
                    'label'         => 'Participants',
                    'class'         => 'EasyRoom\AppBundle\Entity\Utilisateur',
                    'choice_label'  => 'choiceLabel',
                    'multiple'      => true,
                    'required'      => false,
                    'query_builder' => function(EntityRepository $repository) use ($options) {
                        return $repository->createQueryBuilder('u')->where('u.id <> :idUtilisateur')
                                ->setParameter('idUtilisateur', $options['idUtilisateur']);
                    }
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class'    => 'EasyRoom\AppBundle\Entity\Reservation',
            'idUtilisateur' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'easyroom_appbundle_reservation';
    }

}
