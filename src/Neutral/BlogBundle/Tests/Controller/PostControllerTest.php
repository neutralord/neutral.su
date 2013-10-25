<?php

namespace Neutral\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
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

    public function testList()
    {
        $posts = $this->em
            ->getRepository('NeutralBlogBundle:Post')
            ->findAll()
        ;
        
        $client = static::createClient();

        $crawler = $client->request('GET', $this->router->generate('neutral_blog_index'));
        foreach ($posts as $post) {
            $this->assertGreaterThan(
                0,
                $crawler->filter('html:contains("' . $post->getTitle() . '")')->count()
            );
        }
    }
    
    public function testPost()
    {
        $post = $this->em->createQueryBuilder()
                ->select('p')
                ->from('NeutralBlogBundle:Post', 'p')
                ->getQuery()
                ->setMaxResults(1)
                ->getSingleResult()
        ;
        
        $client = static::createClient();

        $crawler = $client->request(
                'GET',
                $this->router->generate(
                        'neutral_blog_post',
                        ['slug' => $post->getSlug()]
                )
        );
        
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("' . $post->getTitle() . '")')->count()
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