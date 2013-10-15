<?php

namespace Neutral\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Neutral\BlogBundle\Entity\Tag;

class LoadTagData extends AbstractFixture implements OrderedFixtureInterface
{   
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $tag = new Tag();
        $tag->setTitle('Sample tag')
                ->setSlug('sample-tag')
                ->setWeight(1)
        ;
        
        $tag2 = new Tag();
        $tag2->setTitle('Another tag')
                ->setSlug('another-tag')
                ->setWeight(2)
        ;
        
        $post = $this->getReference('post');
        $post->addTag($tag)
                ->addTag($tag2)
        ;
        
        $manager->persist($tag, $tag2);
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }
}