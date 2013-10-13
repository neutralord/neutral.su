<?php

namespace Neutral\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontendController extends Controller
{
    public function indexAction()
    {
        return $this->render('NeutralFrontendBundle:Frontend:index.html.twig');
    }
}
