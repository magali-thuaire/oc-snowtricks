<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{
    #[Route('/', name: 'app_trick')]
    public function index(TrickRepository $trick_repository): Response
    {
        $tricks = $trick_repository->findAll();

        return $this->render('trick/index.html.twig', [
            'tricks' => $tricks,
        ]);
    }
}
