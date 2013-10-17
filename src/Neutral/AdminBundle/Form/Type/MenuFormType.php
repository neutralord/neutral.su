<?php

namespace Neutral\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Neutral\AdminBundle\Form\Type\MenuItemFormType;

class MenuFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title')
        ->add('alias')
        ->add('template')
        ->add('items', 'collection', [
                'type' => new MenuItemFormType(),
                'allow_add' => true,
                'allow_delete' => true,
            ])
        ->add('save', 'submit')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'intention'  => 'admin',
        ));
    }

    public function getName()
    {
        return 'neutral_menu';
    }
}
