<?php

namespace Neutral\BlockBundle\Block;

use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Neutral\BlockBundle\Block\Block;

class BlockFactory
{
    protected $templateEngine;
    protected $blockClass = 'Neutral\BlockBundle\Block\Block';
    protected $blockType;
    protected $blockName;
    protected $template;
    protected $container;


    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
        return $this;
    }
    
    public function setTemplateEngine(EngineInterface $templateEngine)
    {
        $this->templateEngine = $templateEngine;
        return $this;
    }
    
    public function getTemplateEngine()
    {
        if ($this->templateEngine instanceof EngineInterface) {
            return $this->templateEngine;
        } else {
            return $this->container->get('templating');
        }
    }
    
    public function setClass($blockClass)
    {
        $this->blockClass = $blockClass;
        return $this;
    }
    
    public function setType($blockType)
    {
        $this->blockType = $blockType;
        return $this;
    }
    
    public function setName($blockName)
    {
        $this->blockName = $blockName;
        return $this;
    }
    
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }
    
    public function getBlock()
    {
        return new $this->blockClass(
                $this->getTemplateEngine(),
                $this->template,
                $this->blockType,
                $this->blockName
        );
    }
}