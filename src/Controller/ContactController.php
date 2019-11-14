<?php

namespace App\Controller;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ContactController
 * @package App\Controller
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/contact", methods={"GET"}, name="contact_page")
     * @param string $template
     * @return Response
     */
    public function showContactInfo(string $template = "blog/contact.html.twig"): Response
    {
        $contactRepo = $this->getDoctrine()->getRepository(Contact::class);
        $contact = $contactRepo->findAll();

        return $this->render($template, [
            'contact' => !empty($contact) ? $contact[0] : null,

        ]);
    }
}
