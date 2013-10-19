<?php

namespace Neutral\BlockBundle\Block;

use Symfony\Component\Templating\EngineInterface;

abstract class AbstractBlock implements BlockInterface
{
    protected $template;
    protected $templateEngine;
    protected $type;
    protected $name;
    protected $parameters;
    
    public function __construct(EngineInterface $templateEngine, $template, $blockType, $blockName)
    {
        $this->templateEngine = $templateEngine;
        $this->template = $template;
        $this->type = $blockType;
        $this->name = $blockName;
    }
    
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
        return $this;
    }
    
    public function render($parameters)
    {
        $parameters = array_replace($this->parameters, $parameters);
        return $this->templateEngine->render(
                $this->template,
                $parameters
        );
    }
}