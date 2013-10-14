<?php

namespace Neutral\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller
{
    public function loginAction()
    {
        $request = $this->container->get('request');
        /* @var $request \Symfony\Component\HttpFoundation\Request */
        $session = $request->getSession();
        /* @var $session \Symfony\Component\HttpFoundation\Session\Session */

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        if ($error) {
            $error = $error->getMessage();
        }
        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);

        $csrfToken = $this->get('form.csrf_provider')->generateCsrfToken('authenticate');

        return $this->render(
                'NeutralUserBundle:Security:login.html.twig',
                [
                    'last_username' => $lastUsername,
                    'error'         => $error,
                    'csrf_token' => $csrfToken,
                ]
        );
    }
    
    public function logoutAction()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }
}
