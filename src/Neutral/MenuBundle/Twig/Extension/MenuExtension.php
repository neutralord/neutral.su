<?php

namespace Neutral\MenuBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MenuExtension extends \Twig_Extension
{
    private $em;
    private $templating;

    public function __construct(EntityManager $em, ContainerInterface $container)
    {
        /** TODO: Find another way to inject twig service */
        $this->templating = $container->get('twig');
        $this->em = $em;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('menu', [$this, 'renderMenu'], ['is_safe' => ['html']]),
        );
    }
    
    public function renderMenu($alias)
    {
        $menu = $this->em
                ->getRepository('NeutralMenuBundle:Menu')
                ->findOneBy(['alias' => $alias])
        ;
        if (null === $menu) {
            throw new \Exception(sprintf('Undefined menu alias "%s"', $alias));
        }
        
        $template = $menu->getTemplate() ? $menu->getTemplate() : 'NeutralMenuBundle:Menu:menu.html.twig';
        
        return $this->templating->render(
                $template,
                ['menu' => $menu]
        );
    }

    public function getName()
    {
        return 'menu';
    }
}
