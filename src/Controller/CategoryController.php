<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Subcategory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CategoryController
 * @package App\Controller
 */
class CategoryController extends AbstractController
{
    public function showCategories(string $template): Response
    {
        $getParams = $_GET['get'] ?? null;
        $categoryId = $subCategoryId = null;

        if(null !== $getParams){
            $categoryId = intval($getParams['category']) ? $getParams['category'] : $categoryId;
            $subCategoryId = intval($getParams['subcategory']) ? $getParams['subcategory'] : $subCategoryId;
        }

        $repositoryCategories = $this->getDoctrine()->getRepository(Category::class);
        $repositorySubCategories = $this->getDoctrine()->getRepository(Subcategory::class);

        return $this->render($template, [
            'categoryId' => $categoryId,
            'categories' => $repositoryCategories->findAll(),
            'subcategoryId' => $subCategoryId,
            'subcategories' => $repositorySubCategories->findAll(),

        ]);
    }
}
