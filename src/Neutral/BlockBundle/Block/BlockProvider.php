<?php

namespace Neutral\BlockBundle\Block;

class BlockProvider
{
    protected $repositories = array();
    protected $repositoriesByType = array();
    
    public function addRepository(BlockRepositoryInterface $repository)
    {
        $this->repositories[] = $repository;
        $taskType = $repository->getType();
        if (!array_key_exists($taskType, $this->repositoriesByType)) {
            $this->repositoriesByType[$taskType] = array();
        }
        $this->repositoriesByType[$taskType][] = $repository;
    }
    
    public function getBlock($blockType, $blockName)
    {
        if (!array_key_exists($blockType, $this->repositoriesByType)) {
            throw new \Exception('Undefined block type');
        }
        
        foreach ($this->repositoriesByType[$blockType] as $repository) {
            $task = $repository->getBlock($blockName);
            if (null !== $task) {
                return $task;
            }
        }
        return null;
    }
}