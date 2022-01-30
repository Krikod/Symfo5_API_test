<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ApiItemController extends AbstractController
{
    /**
     * @Route("/api/item", name="api_item_index", methods={"GET"})
     *
     */
    public function index(AnnonceRepository $annonceRepository): Response
    {
        return $this->json($annonceRepository->findAll(), 200, [], ['groups' => 'annonce:read']);

    }
}
