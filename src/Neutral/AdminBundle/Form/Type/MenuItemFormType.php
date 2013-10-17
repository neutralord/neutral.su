<?php

namespace Neutral\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MenuItemFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
        ->add('url')
        ->add('ordinate')
        ->add('active', null, ['required' => false])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'intention'  => 'admin',
            'data_class' => '\Neutral\MenuBundle\Entity\MenuItem',
        ));
    }

    public function getName()
    {
        return 'neutral_menu_item';
    }
}
