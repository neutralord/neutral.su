<?php

namespace Neutral\BlockBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Neutral\BlockBundle\DependencyInjection\Compiler\BlockRepositoryCompilerPass;

class NeutralBlockBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new BlockRepositoryCompilerPass());
    }
}
