<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryController
 * @Route("/admin/category")
 * @IsGranted("ROLE_ADMIN")
 * @package App\Controller
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"}, name="admin_category_index")
     *
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('admin/category/index.html.twig', [
            'categories' => $categories,
        ]);

    }

    /**
     * Creates a new Category entity.
     *
     * @Route("/new", methods={"GET", "POST"}, name="admin_category_new")
     *
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $category = new Category();
        $category->setAuthor($this->getUser());

        $form = $this->createForm(CategoryType::class, $category)
            ->add('saveAndCreateNew', SubmitType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            if ($form->get('saveAndCreateNew')->isClicked()) {
                return $this->redirectToRoute('admin_category_new');
            }

            return $this->redirectToRoute('admin_category_index');
        }

        return $this->render('admin/category/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing category entity.
     *
     * @Route("/{id<\d+>}/edit",methods={"GET", "POST"}, name="admin_category_edit")
     * IsGranted("edit", subject="category", message="Category can only be edited by their authors.")
     *
     * @param Request $request
     * @param Category $category
     * @return Response
     */
    public function edit(Request $request, Category $category): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'post.updated_successfully');

            return $this->redirectToRoute('admin_category_edit', ['id' => $category->getId()]);
        }

        return $this->render('admin/category/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
            'include_back_to_home_link' => true
        ]);
    }

    /**
     * Deletes a category entity.
     *
     * @Route("/{id}/delete", methods={"POST"}, name="admin_category_delete")
     * IsGranted("delete", subject="category", message="Category can not be delete")
     *
     * @param Request $request
     * @param Category $category
     * @return Response
     */
    public function delete(Request $request, Category $category): Response
    {
        if (!$this->isCsrfTokenValid('delete', $request->request->get('token'))) {
            return $this->redirectToRoute('admin_category_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();

        $this->addFlash('success', 'post.deleted_successfully');

        return $this->redirectToRoute('admin_category_index');
    }

}
