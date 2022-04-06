<?php

namespace App\Controller;

use App\Entity\Media;
use App\Repository\MediaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Contracts\Translation\TranslatorInterface;

class MediaController extends AbstractController
{
    #[Route('/media/confirm-remove/{id}', name: 'app_media_confirm_remove', methods: ['GET'])]
    public function confirmRemove(Media $media): Response
    {
        $this->denyAccessUnlessGranted('MANAGE', $media->getTrick());

        return $this->render('media/delete_modal.twig', [
            'media' => $media,
        ]);
    }

    #[Route('/media/remove/{id}', name: 'app_media_remove')]
    public function remove(Media $media, MediaRepository $mediaRepository, Request $request, TranslatorInterface $translator): RedirectResponse
    {
        $this->denyAccessUnlessGranted('MANAGE', $trick = $media->getTrick());

        if (!$this->isCsrfTokenValid('delete' . $media->getId(), $request->get('_token'))) {
            throw new InvalidCsrfTokenException();
        }

        if ($media === $media->getTrick()->getFeaturedImage()) {
            $trick->setNewFeaturedImage();
        }

        $mediaRepository->remove($media);
        $this->addFlash('success', $translator->trans('media.remove.success', ['trick.title' => strtoupper($trick->getTitle())], 'flashes'));

        return $this->redirectToRoute('app_trick', [
            '_fragment' => 'tricks'
        ]);
    }

    #[Route('/media/confirm-change/{id}', name: 'app_media_confirm_change', methods: ['GET'])]
    public function confirmChangeFeaturedImage(Media $media): Response
    {
        $this->denyAccessUnlessGranted('MANAGE', $media->getTrick());

        return $this->render('media/change_modal.twig', [
            'media' => $media,
        ]);
    }

    #[Route('/media/change/{id}', name: 'app_media_change', methods: ['POST'])]
    public function changeFeaturedImage(Media $media, Request $request, EntityManagerInterface $entityManager, TranslatorInterface $translator): RedirectResponse
    {
        $this->denyAccessUnlessGranted('MANAGE', $trick = $media->getTrick());

        if (!$this->isCsrfTokenValid('change' . $media->getId(), $request->get('_token'))) {
            throw new InvalidCsrfTokenException();
        }

        $trick->setFeaturedImage($media);
        $entityManager->flush();

        $this->addFlash('success', $translator->trans('media.change.success', ['trick.title' => strtoupper($trick->getTitle())], 'flashes'));

        return $this->redirectToRoute('app_trick', [
            '_fragment' => 'tricks'
        ]);
    }
}
