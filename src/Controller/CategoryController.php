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
        $repositoryCategories = $this->getDoctrine()->getRepository(Category::class);
        $repositorySubCategories = $this->getDoctrine()->getRepository(Subcategory::class);

        $categories = [];
        foreach ($repositoryCategories->findAll() as $category) {
            $categories[$category->getId()]['cat'] = $category;
            $categories[$category->getId()]['subcat'] = $repositorySubCategories->findBy(['category' => $category->getId()]);
        }

        return $this->render($template, [
            'categories' => $categories,

        ]);
    }
}
