<?php

namespace Neutral\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Neutral\BlogBundle\Entity\Post;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder()
                ->add('select', 'p')
                ->add('from', 'NeutralBlogBundle:Post p')
                ->add('orderBy', 'p.createdAt DESC')
        ;
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            $qb->add('where', 'p.published = true');
        }
        $paginator  = $this->get('knp_paginator');
        $posts = $paginator->paginate(
                $qb->getQuery(),
                $request->get('page', 1),
                3
        );
        
        return $this->render('NeutralBlogBundle:Post:list.html.twig', [
            'posts' => $posts,
        ]);
    }
    
    public function postAction(Post $post)
    {
        if (!$post->getPublished() && !$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new NotFoundHttpException('Post is in the drafts.');
        }
        return $this->render('NeutralBlogBundle:Post:post.html.twig', array('post' => $post));
    }
}
