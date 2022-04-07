<?php

namespace App\Controller;

use App\Entity\Trick;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/comment/{trick}', name:'app_comment_load', methods: ['GET'])]
    public function load(Trick $trick, Request $request)
    {
        $multiple = $request->get('click') + 1;

        return $this->render('comment/_index.html.twig', [
            'trick' => $trick,
            'multiple' => $multiple,
        ]);
    }
}
