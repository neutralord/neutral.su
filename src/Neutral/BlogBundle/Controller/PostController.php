<?php

namespace Neutral\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Neutral\BlogBundle\Entity\Post;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();$qb = $em->createQueryBuilder();
        $query = $qb->add('select', 'p')
            ->add('from', 'NeutralBlogBundle:Post p')
        ;
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            $query->add('where', 'p.published = true');
        }
        $posts = $query->add('orderBy', 'p.createdAt DESC')
            ->getQuery()
            ->getResult()
        ;
        return $this->render('NeutralBlogBundle:Post:list.html.twig', array('posts' => $posts));
    }
    
    public function postAction(Post $post)
    {
        if (!$post->getPublished() && !$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new NotFoundHttpException('Post is in the drafts.');
        }
        return $this->render('NeutralBlogBundle:Post:post.html.twig', array('post' => $post));
    }
}
