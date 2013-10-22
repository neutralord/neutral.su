<?php

namespace Neutral\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Neutral\AdminBundle\Form\DataTransformer\CollectionToStringTransformer;
use Doctrine\Common\Persistence\ObjectManager;

class TagsType extends AbstractType
{

    protected $em;

    public function __construct(ObjectManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addViewTransformer(
            new CollectionToStringTransformer(
                    $this->em,
                    'NeutralBlogBundle:Tag',
                    'title'
            )
        );
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'tags';
    }
}