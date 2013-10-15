<?php

namespace Neutral\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Neutral\BlogBundle\Entity\Post;

class PostController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('NeutralBlogBundle:Post')->findAll();
        return $this->render('NeutralBlogBundle:Post:list.html.twig', array('posts' => $posts));
    }
    
    public function postAction(Post $post)
    {
        return $this->render('NeutralBlogBundle:Post:post.html.twig', array('post' => $post));
    }
}
