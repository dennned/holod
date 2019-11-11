<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Contact;
use App\Form\PostType;
use App\Utils\Slugger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ContactController
 * @Route("/admin/contact")
 * @package App\Controller
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/{id<\d+>}/edit",methods={"GET", "POST"}, name="contact_edit")
     */
    public function edit(Request $request, Contact $contact): Response
    {
//        return $this->render('contact/index.html.twig', [
//            'controller_name' => 'ContactController',
//        ]);

//        $form = $this->createForm(PostType::class, $contact);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $post->setSlug(Slugger::slugify($post->getTitle()));
//
//            /** @var UploadedFile $image */
//            $image = $form['image']->getData();
//
//            if($image) {
//                //upload image
//                $newFilename = $fileUploader->upload($image);
//
//                // delete old image
//                if(null !== $post->getImageName()){
//                    $fileUploader->delete($post->getImageName());
//                }
//
//                $post->setImageName($newFilename);
//            }
//
//            $this->getDoctrine()->getManager()->flush();
//
//            $this->addFlash('success', 'post.updated_successfully');
//
//            return $this->redirectToRoute('admin_post_edit', ['id' => $post->getId()]);
//        }
//
//        return $this->render('admin/blog/edit.html.twig', [
//            'post' => $post,
//            'form' => $form->createView(),
//        ]);
    }
}
