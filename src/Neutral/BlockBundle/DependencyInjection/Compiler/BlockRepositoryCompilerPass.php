<?php

namespace Neutral\BlockBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class BlockRepositoryCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('neutral_block.provider')) {
            return;
        }

        $definition = $container->getDefinition(
            'neutral_block.provider'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'neutral_block.repository'
        );
        foreach ($taggedServices as $id => $attributes) {
            $definition->addMethodCall(
                'addRepository',
                array(new Reference($id))
            );
        }
    }
}