<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace EasyRoom\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationType
        extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder->remove('username');
        $builder->add('nom', TextType::class, array('label' => 'form.lastname', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('prenom', TextType::class, array('label' => 'form.firstname', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('roles', ChoiceType::class, array(
              'choices' => array(
                  'roles.user' => 'ROLE_USER',
                  'roles.admin' => 'ROLE_ADMIN'
              ),
              'required' => true,
              'multiple'=> true,
              'mapped' => true,
              'label' => 'form.roles', 'translation_domain' => 'FOSUserBundle'
            ));
    }

    public function getParent() {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix() {
        return 'easyroom_user_registration';
    }

    // For Symfony 2.x
    public function getName() {
        return $this->getBlockPrefix();
    }

}
