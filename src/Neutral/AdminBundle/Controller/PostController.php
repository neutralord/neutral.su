<?php

namespace Neutral\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Neutral\BlogBundle\Entity\Post;
use Neutral\AdminBundle\Form\Type\PostFormType;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('NeutralBlogBundle:Post')->findAll();
        
        return $this->render(
                'NeutralAdminBundle:Post:list.html.twig',
                ['posts' => $posts]
        );
    }
    
    public function editAction(Request $request, $postId)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('NeutralBlogBundle:Post')->find($postId);
        
        $form = $this->createForm(new PostFormType(), $post);
        
        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $post = $form->getData();
                $em->flush();
                
                return $this->redirect($this->generateUrl('neutral_admin_post_list'));
            }
        }
        
        return $this->render(
                'NeutralAdminBundle:Page:edit.html.twig',
                ['post' => $post, 'form' => $form->createView()]
        );
    }
    
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $post = new Post();
        
        $form = $this->createForm(new PostFormType(), $post);
        
        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $post = $form->getData();
                $em->persist($post);
                $em->flush();
                
                return $this->redirect($this->generateUrl('neutral_admin_post_list'));
            }
        }
        
        return $this->render(
                'NeutralAdminBundle:Post:edit.html.twig',
                ['post' => $post, 'form' => $form->createView()]
        );
    }
    
    public function deleteAction($postId)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('NeutralBlogBundle:Post')->find($postId);
        $em->remove($post);
        $em->flush();
        
        return $this->redirect($this->generateUrl('neutral_admin_post_list'));
    }
}
