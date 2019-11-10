<?php


namespace App\Controller\Admin;


use App\Entity\Category;
use App\Entity\Subcategory;
use App\Form\CategoryType;
use App\Form\SubCategoryType;
use App\Repository\CategoryRepository;
use App\Repository\SubcategoryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/admin/subcategory", methods={"GET"}, name="admin_subcategory_index")
     *
     * @param SubcategoryRepository $subCategoryRepository
     * @return Response
     */
    public function index(SubcategoryRepository $subCategoryRepository): Response
    {
        $subCategories = $subCategoryRepository->findAll();

        return $this->render('admin/subcategory/index.html.twig', [
            'subcategories' => $subCategories,
        ]);

    }

    /**
     * Creates a new SubCategory entity.
     *
     * @Route("/admin/subcategory/new", methods={"GET", "POST"}, name="admin_subcategory_new")
     *
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $subCategory = new Subcategory();

        $form = $this->createForm(SubCategoryType::class, $subCategory)
            ->add('saveAndCreateNew', SubmitType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($subCategory);
            $em->flush();

            if ($form->get('saveAndCreateNew')->isClicked()) {
                return $this->redirectToRoute('admin_subcategory_new');
            }

            return $this->redirectToRoute('admin_subcategory_index');
        }

        return $this->render('admin/subcategory/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing subcategory entity.
     *
     * @Route("/admin/subcategory/{id<\d+>}/edit",methods={"GET", "POST"}, name="admin_subcategory_edit")
     *
     * @param Request $request
     * @param Subcategory $subCategory
     * @return Response
     */
    public function edit(Request $request, Subcategory $subCategory): Response
    {
        $form = $this->createForm(SubCategoryType::class, $subCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'post.updated_successfully');

            return $this->redirectToRoute('admin_subcategory_edit', ['id' => $subCategory->getId()]);
        }

        return $this->render('admin/subcategory/edit.html.twig', [
            'subcategory' => $subCategory,
            'form' => $form->createView(),
            'include_back_to_home_link' => true
        ]);
    }

    /**
     * Deletes a subcategory entity.
     *
     * @Route("/admin/subcategory/{id}/delete", methods={"POST"}, name="admin_subcategory_delete")
     *
     * @param Request $request
     * @param Subcategory $subCategory
     * @return Response
     */
    public function delete(Request $request, Subcategory $subCategory): Response
    {
        if (!$this->isCsrfTokenValid('delete', $request->request->get('token'))) {
            return $this->redirectToRoute('admin_subcategory_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($subCategory);
        $em->flush();

        $this->addFlash('success', 'post.deleted_successfully');

        return $this->redirectToRoute('admin_subcategory_index');
    }

    /**
     * AJAX return
     * @Route("admin/post/subcat/{id}", name="subcat_show", methods={"GET"})
     * @Route("admin/post/{id_category}/subcat/{id}", name="subcat_show_idcat", methods={"GET"})
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
