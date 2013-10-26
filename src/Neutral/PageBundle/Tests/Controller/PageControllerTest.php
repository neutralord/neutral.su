<?php

namespace Neutral\PageBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PageControllerTest extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * @var \Symfony\Bundle\FrameworkBundle\Routing\Router
     */
    private $router;
    
    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $container = static::$kernel->getContainer();
        $this->em = $container->get('doctrine')->getManager()
        ;
        $this->router = $container->get('router');
    }
    
    public function testPage()
    {
        $page = $this->em->createQueryBuilder()
                ->select('p')
                ->from('NeutralPageBundle:Page', 'p')
                ->getQuery()
                ->setMaxResults(1)
                ->getSingleResult()
        ;
        
        $client = static::createClient();

        $crawler = $client->request(
                'GET',
                $this->router->generate(
                        'neutral_page_view',
                        ['slug' => $page->getSlug()]
                )
        );
        
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("' . $page->getTitle() . '")')->count()
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
        $this->em->close();
    }
}