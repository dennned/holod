<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Form\PostType;
use App\Repository\ContactRepository;
use App\Repository\SubcategoryRepository;
use App\Utils\Slugger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ContactController
 * @Route("/admin/contact-info")
 * @package App\Controller
 */
class ContactController extends AbstractController
{

    /**
     * @var ContactRepository
     */
    private $contactRepository;

    /**
     * SubCategoryController constructor.
     * @param ContactRepository $contactRepository
     */
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * @Route("/edit",methods={"GET", "POST"}, name="contact_edit")
     *
     * @param Request $request
     * @return Response
     */
    public function edit(Request $request): Response
    {

        $contact = $this->contactRepository->findAll();

        if(empty($contact)) {
            // create new contact info
            $contact = new Contact();
            $contact->setContactInfo(' ');

            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
        }

        if(is_array($contact)) {
            $contact = $contact[0];

            $form = $this->createForm(ContactType::class, $contact);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                $this->addFlash('success', 'post.updated_successfully');

                return $this->redirectToRoute('contact_edit');
            }

            return $this->render('admin/contact/edit.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    }
}
