<?php

namespace Neutral\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Neutral\BlogBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Response;

class FeedController extends Controller
{
    public function atomAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('NeutralBlogBundle:Post')->findAll();
        
        $atom = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?>
            <feed xmlns="http://www.w3.org/2005/Atom" />
        ');
        $atom->addChild('id', 'http://neutral.su/blog/');
        $atom->addChild('title', 'neutral\'s blog');
        $atom->addChild('link')
                ->addAttribute('href', 'http://neutral.su/blog/');
        $selfLink = $atom->addChild('link');
        $selfLink->addAttribute('rel', 'self');
        $selfLink->addAttribute('href', 'http://neutral.su/blog/atom.xml');
        $atom->addChild('author')
                ->addChild('name', 'Nikita Dementev');
        // TODO: change 'updated' to actual date
        $atom->addChild(
                    'updated',
                    $posts[0]->getUpdatedAt()->format(\DateTime::ATOM)
            );
        
        foreach ($posts as $post) {
            $entry = $atom->addChild('entry');
            $entry->addChild('id', $this->generateUrl(
                    'neutral_blog_post',
                    ['slug' => $post->getSlug()],
                    true
            ));
            $entry->addChild('title', $post->getTitle());
            $entry->addChild('link')
                    ->addAttribute('href', $this->generateUrl(
                            'neutral_blog_post',
                            ['slug' => $post->getSlug()],
                            true
                    ));
            $entry->addChild(
                    'updated',
                    $post->getUpdatedAt()->format(\DateTime::ATOM)
            );
            $entry->addChild('content', $post->getFullText())
                    ->addAttribute('type', 'html');
            
        }
        
        $response = new Response(
                $atom->asXML(),
                200,
                ['Content-Type' => 'application/atom+xml']
        );
        return $response;
    }
}
