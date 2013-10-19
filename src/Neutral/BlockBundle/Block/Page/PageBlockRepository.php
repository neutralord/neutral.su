<?php

namespace Neutral\BlockBundle\Block\Page;

use Neutral\BlockBundle\Block\BlockRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Neutral\BlockBundle\Block\BlockFactory;

class PageBlockRepository implements BlockRepositoryInterface
{
    private $em;
    private $blockFactory;
    
    public function __construct(EntityManager $em, BlockFactory $blockFactory)
    {
        $this->em = $em;
        $this->blockFactory = $blockFactory;
    }

        public function getType()
    {
        return 'page';
    }
    
    public function getBlock($blockName)
    {
        $block = $this->blockFactory
                ->setName($blockName)
                ->setType('page')
                ->setTemplate('NeutralBlockBundle:PageBlock:block.html.twig')
                ->getBlock()
        ;
        $page = $this->em->getRepository('NeutralPageBundle:Page')->findOneBy(['slug' => $blockName]);
        if (null === $page) {
            return null;
        }
        
        $block->setParameters(['page' => $page]);
        
        return $block;
    }
}