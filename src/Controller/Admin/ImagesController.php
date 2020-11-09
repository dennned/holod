<?php

namespace App\Controller\Admin;

use App\Entity\Images;
use App\Repository\ImagesRepository;
use App\Service\FileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ImagesController
 * @package App\Controller\Admin
 */
class ImagesController extends AbstractController
{

    const PATH_FOLDER = '../../public/media/cache/post_admin/uploads/images';

    /**
     * @var ImagesRepository
     */
    private $imagesRepository;

    /**
     * @var FileUploader
     */
    private $fileUploader;

    /**
     * ImagesController constructor.
     * @param ImagesRepository $subcategoryRepository
     */
    public function __construct(ImagesRepository $imagesRepository, FileUploader $fileUploader)
    {
        $this->imagesRepository = $imagesRepository;
        $this->fileUploader = $fileUploader;
    }


    /**
     * AJAX return
     * @Route("admin/post/delete/images/{id}", name="delete_images", methods={"GET"})
     *
     * @param int $id
     * @return JsonResponse
     */
    public function deleteImages(int $id): JsonResponse
    {
        try {
            $image = $this->imagesRepository->findOneById($id);

            // delete from server
            $this->fileUploader->delete($image->getName(), $mode = 'cache');

            $em = $this->getDoctrine()->getManager();
            $em->remove($image);
            $em->flush();
        } catch (\Exception $e) {
            return new JsonResponse(['status' => false]);
        }

        return new JsonResponse(['status'=> true]);
    }
}
