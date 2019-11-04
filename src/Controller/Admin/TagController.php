<?php

namespace App\Controller\Admin;

use App\Repository\TagRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TagController
 * @Route("/admin/tag")
 * @IsGranted("ROLE_ADMIN")
 * @package App\Controller
 */
class TagController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"}, name="admin_tag_index")
     * @param TagRepository $tagRepository
     * @return Response
     */
    public function index(TagRepository $tagRepository): Response
    {
        $tags = $tagRepository->findAll();

//        dump($tags);
//        die;

        return $this->render('admin/tag/index.html.twig', [
            'tags' => $tags,
        ]);
    }
}
