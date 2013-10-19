<?php

namespace Neutral\BlockBundle\Block;

interface BlockRepositoryInterface
{
    public function getBlock($blockName);
    public function getType();
}