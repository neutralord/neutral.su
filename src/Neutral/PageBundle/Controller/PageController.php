<?php

namespace Neutral\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Neutral\PageBundle\Entity\Page;
class PageController extends Controller
{
    public function viewAction(Page $page)
    {
        return $this->render('NeutralPageBundle:Page:view.html.twig', array('page' => $page));
    }
}
