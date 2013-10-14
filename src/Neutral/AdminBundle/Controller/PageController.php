<?php

namespace Neutral\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Neutral\PageBundle\Entity\Page;
use Neutral\AdminBundle\Form\Type\PageFormType;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pages = $em->getRepository('NeutralPageBundle:Page')->findAll();
        
        return $this->render(
                'NeutralAdminBundle:Page:list.html.twig',
                ['pages' => $pages]
        );
    }
    
    public function editAction(Request $request, $pageId)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('NeutralPageBundle:Page')->find($pageId);
        
        $form = $this->createForm(new PageFormType(), $page);
        
        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $page = $form->getData();
                $em->flush();
                
                return $this->redirect($this->generateUrl('neutral_admin_page_list'));
            }
        }
        
        return $this->render(
                'NeutralAdminBundle:Page:edit.html.twig',
                ['page' => $page, 'form' => $form->createView()]
        );
    }
    
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $page = new Page();
        
        $form = $this->createForm(new PageFormType(), $page);
        
        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $page = $form->getData();
                $em->persist($page);
                $em->flush();
                
                return $this->redirect($this->generateUrl('neutral_admin_page_list'));
            }
        }
        
        return $this->render(
                'NeutralAdminBundle:Page:edit.html.twig',
                ['page' => $page, 'form' => $form->createView()]
        );
    }
    
    public function deleteAction($pageId)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('NeutralPageBundle:Page')->find($pageId);
        $em->remove($page);
        $em->flush();
        
        return $this->redirect($this->generateUrl('neutral_admin_page_list'));
    }
}
