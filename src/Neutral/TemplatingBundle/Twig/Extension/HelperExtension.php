<?php

namespace Neutral\TemplatingBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

class HelperExtension extends \Twig_Extension
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction(
                    'container_parameter',
                    [$this, 'renderParameter'],
                    ['is_safe' => ['html']]
            ),
        );
    }
    
    public function renderParameter($name)
    {
        return $this->container->getParameter($name);
    }

    public function getName()
    {
        return 'helper';
    }
}
