<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentFormType;
use App\Repository\TrickRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;

class TrickController extends AbstractController
{
    #[Route('/', name: 'app_trick')]
    public function index(TrickRepository $trickRepository): Response
    {
        $tricks = $trickRepository->findAllOrderedByNewest();

        return $this->render('trick/index.html.twig', [
            'tricks' => $tricks,
        ]);
    }

    #[Route('/trick/confirm-remove/{id}', name: 'app_trick_confirm_remove', methods: ['GET'])]
    #[IsGranted('MANAGE', subject: 'trick')]
    public function confirmRemove(Trick $trick): Response
    {
        return $this->render('trick/delete_modal.twig', [
            'trick' => $trick,
        ]);
    }

    #[Route('/trick/remove/{id}', name: 'app_trick_remove')]
    #[IsGranted('MANAGE', subject: 'trick')]
    public function remove(Trick $trick, TrickRepository $trickRepository, Request $request)
    {
        if (!$this->isCsrfTokenValid('delete' . $trick->getId(), $request->get('_token'))) {
            throw new InvalidCsrfTokenException();
        }

        $trickRepository->remove($trick);
        $this->addFlash('success', 'trick.remove.success');

        return $this->redirectToRoute('app_trick', [
            '_fragment' => 'tricks'
        ]);
    }

    /**
     * @throws NonUniqueResultException
     */
    #[Route('/trick/{slug}', name: 'app_trick_show')]
    public function show(string $slug, Request $request, EntityManagerInterface $entityManager, TrickRepository $trickRepository): Response
    {
        $trick = $trickRepository->findOneBySlug($slug);

        if (!$trick) {
            throw new NotFoundHttpException('Trick not found');
        }

        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment
                ->setCommentedBy($this->getUser())
                ->setTrick($trick)
            ;

            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('app_trick_show', ['slug' => $trick->getSlug()]);
        }

        return $this->render('trick/show.html.twig', [
            'trick' => $trick,
            'commentForm' => $form->createView()
        ]);
    }
}
