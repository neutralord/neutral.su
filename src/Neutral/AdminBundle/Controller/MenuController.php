<?php

namespace Neutral\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Neutral\MenuBundle\Entity\Menu;
use Neutral\AdminBundle\Form\Type\MenuFormType;
use Symfony\Component\HttpFoundation\Request;

class MenuController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $menuList = $em->getRepository('NeutralMenuBundle:Menu')->findAll();
        
        return $this->render(
                'NeutralAdminBundle:Menu:list.html.twig',
                ['menuList' => $menuList]
        );
    }
    
    public function editAction(Request $request, $menuId)
    {
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository('NeutralMenuBundle:Menu')->find($menuId);
        
        $form = $this->createForm(new MenuFormType(), $menu);
        
        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $menu = $form->getData();
                $em->flush();
                
                return $this->redirect($this->generateUrl('neutral_admin_menu_list'));
            }
        }
        
        return $this->render(
                'NeutralAdminBundle:Menu:edit.html.twig',
                ['menu' => $menu, 'form' => $form->createView()]
        );
    }
    
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $menu = new Menu();
        
        $form = $this->createForm(new MenuFormType(), $menu);
        
        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $menu = $form->getData();
                $em->persist($menu);
                $em->flush();
                
                return $this->redirect($this->generateUrl('neutral_admin_menu_list'));
            }
        }
        
        return $this->render(
                'NeutralAdminBundle:Menu:edit.html.twig',
                ['menu' => $menu, 'form' => $form->createView()]
        );
    }
    
    public function deleteAction($menuId)
    {
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository('NeutralMenuBundle:Menu')->find($menuId);
        $em->remove($menu);
        $em->flush();
        
        return $this->redirect($this->generateUrl('neutral_admin_menu_list'));
    }
}
