<?php

namespace App\Controller\Admin;

use App\Repository\CategoryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
