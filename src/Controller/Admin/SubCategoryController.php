<?php


namespace App\Controller\Admin;


use App\Repository\SubcategoryRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SubCategoryController
 * @package App\Controller\Admin
 */
class SubCategoryController extends AbstractController
{

    /**
     * @var SubcategoryRepository
     */
    private $subcategoryRepository;

    /**
     * SubCategoryController constructor.
     * @param SubcategoryRepository $subcategoryRepository
     */
    public function __construct(SubcategoryRepository $subcategoryRepository)
    {
        $this->subcategoryRepository = $subcategoryRepository;
    }

    /**
     * @Route("admin/post/subcat/{id}", name="subcat_show", methods={"GET"})
     *
     * @param int $id
     * @return JsonResponse
     */
    public function getSubCategories(int $id): JsonResponse
    {
        try {
            $subCategories = $this->subcategoryRepository->findByCategory($id);

            if (empty($subCategories)) {
                return new JsonResponse([]);
            }

        } catch (\Exception $e) {
            return new JsonResponse([]);
        }

        $formatted = [];
        foreach ($subCategories as $subCategory) {
            $formatted[] = [
                'id' => $subCategory->getId(),
                'name' => $subCategory->getName(),
            ];
        }

        return new JsonResponse($formatted);
    }
}
