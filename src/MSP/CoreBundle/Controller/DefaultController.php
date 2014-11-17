<?php

namespace MSP\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/app")
 */
class DefaultController extends Controller
{
    /**
     * Comentariu
     *
     * @Route("/post/{id}", name="hello", defaults={"id" = "1"})
     * @Template()
     */
    public function helloAction($id)
    {
        // msp_core_default_hello
        return [
            'id' => $id
        ];
    }

    /**
     * @Route("/contact-us", name="contact")
     * @Template()
     */
    public function contactAction()
    {
        $email = 'contact-us@email.com';

        return [
            'message' => 'Hello',
            'email' => $email
        ];
    }

    /**
     * Comentariu
     *
     * @Route("/if/{var}", name="if")
     * @Template("MSPCoreBundle:Default:if.html.twig")
     */
    public function ifAction($var)
    {
        return [
            'var' => $var
        ];
    }

    /**
     * @Route("/for", name="for")
     * @Template()
     */
    public function forAction()
    {
        $users = ['USer1'];

        return [
            'utilizatori' => $users
        ];
    }
}
