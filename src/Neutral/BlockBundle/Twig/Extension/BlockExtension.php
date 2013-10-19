<?php

namespace Neutral\BlockBundle\Twig\Extension;

use Neutral\BlockBundle\Block\BlockProvider;

class BlockExtension extends \Twig_Extension
{
    private $blockProvider;

    public function __construct(BlockProvider $blockProvider)
    {
        $this->blockProvider = $blockProvider;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction(
                    'neutral_block',
                    [$this, 'renderBlock'],
                    ['is_safe' => ['html']]
            ),
        );
    }
    
    public function renderBlock($blockType, $blockName, $parameters = array())
    {
        return $this->blockProvider
                ->getBlock($blockType, $blockName)
                ->render($parameters);
    }

    public function getName()
    {
        return 'block';
    }
}
