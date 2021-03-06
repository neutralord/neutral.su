<?php

namespace Neutral\PageBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Neutral\PageBundle\Entity\Page;

class LoadPageData extends AbstractFixture implements OrderedFixtureInterface
{   
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $page = new Page();
        $page->setTitle('My own website ^____^')
                ->setBody('Just a website!')
                ->setSlug('home')
                ->setPublished(true)
        ;
        $manager->persist($page);
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}