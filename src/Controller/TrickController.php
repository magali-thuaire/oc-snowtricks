<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Media;
use App\Entity\Trick;
use App\Entity\User;
use App\Form\CommentFormType;
use App\Form\MediaFormType;
use App\Form\TrickFormType;
use App\Repository\TrickRepository;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @method User getUser()
 */
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
    public function remove(Trick $trick, TrickRepository $trickRepository, Request $request, TranslatorInterface $translator): RedirectResponse
    {
        if (!$this->isCsrfTokenValid('delete' . $trick->getId(), $request->get('_token'))) {
            throw new InvalidCsrfTokenException();
        }

        $trickRepository->remove($trick);
        $this->addFlash('success', $translator->trans('trick.remove.success', ['trick.title' => strtoupper($trick->getTitle())], 'flashes'));

        return $this->redirectToRoute('app_trick', [
            '_fragment' => 'tricks'
        ]);
    }

    #[Route('/trick/edit/{slug}', name: 'app_trick_edit')]
    #[IsGranted('MANAGE', subject: 'trick')]
    public function edit(Trick $trick, EntityManagerInterface $entityManager, Request $request, UploaderHelper $uploaderHelper, TranslatorInterface $translator): RedirectResponse|Response
    {
        $editForm = $this->createForm(TrickFormType::class, $trick);
        $editForm->handleRequest($request);

        $featuredImageForm = $this->createForm(MediaFormType::class);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $uploadedFiles = $editForm['medias']->getData();

            if ($uploadedFiles) {
                $this->addImages($uploadedFiles, $uploaderHelper, $trick);

                if (!$trick->getFeaturedImage()) {
                    $featuredImage = $trick->getMedias()->first();
                    $trick->setFeaturedImage($featuredImage);
                }
            }

            $entityManager->flush();
            $this->addFlash('success', $translator->trans('trick.edit.success', ['trick.title' => strtoupper($trick->getTitle())], 'flashes'));

            return $this->redirectToRoute('app_trick', [
                '_fragment' => 'tricks'
            ]);
        }

        return $this->render('trick/edit.html.twig', [
            'trick' => $trick,
            'editForm' => $editForm->createView(),
            'featuredImageForm' => $featuredImageForm->createView()
        ]);
    }

    #[Route('/trick/new', name: 'app_trick_new')]
    #[IsGranted('IS_AUTHENTICATED_REMEMBERED')]
    public function new(Request $request, UploaderHelper $uploaderHelper, EntityManagerInterface $entityManager, TranslatorInterface $translator): RedirectResponse|Response
    {
        $trick = new Trick();
        $newForm = $this->createForm(TrickFormType::class, $trick, ['include_featured_image' => true]);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted() && $newForm->isValid()) {
            // Set author
            $trick->setAuthor($this->getUser());
            // Set featured image
            $uploadedFile = $newForm['file']->getData();
            $media = $this->addImage($uploadedFile, $uploaderHelper, $trick);
            $trick->setFeaturedImage($media);

            // Set medias
            $uploadedFiles = $newForm['medias']->getData();
            if ($uploadedFiles) {
                $this->addImages($uploadedFiles, $uploaderHelper, $trick);
            }

            $entityManager->persist($trick);
            $entityManager->flush();
            $this->addFlash('success', $translator->trans('trick.new.success', ['trick.title' => strtoupper($trick->getTitle())], 'flashes'));

            return $this->redirectToRoute('app_trick', [
                '_fragment' => 'tricks'
            ]);
        }

        return $this->render('trick/new.html.twig', [
            'trick' => $trick,
            'newForm' => $newForm->createView(),
        ]);
    }

    #[Route('/trick/image/{id}', name: 'app_trick_add_image', methods: ['POST'])]
    #[IsGranted('MANAGE', subject: 'trick')]
    public function newFeaturedImage(Trick $trick, Request $request, UploaderHelper $uploaderHelper, EntityManagerInterface $entityManager, TranslatorInterface $translator): RedirectResponse
    {
        $media = new Media();
        $featuredImageForm = $this->createForm(MediaFormType::class, $media);
        $featuredImageForm->handleRequest($request);

        if ($featuredImageForm->isSubmitted() && $featuredImageForm->isValid()) {
            $uploadedFile = $featuredImageForm['file']->getData();

            if ($uploadedFile) {
                $featuredImage = $this->addImage($uploadedFile, $uploaderHelper, $trick);
                $trick->setFeaturedImage($featuredImage);
            }

            $entityManager->flush();
            $this->addFlash('success', $translator->trans(
                'trick.image.success',
                ['trick.title' => strtoupper($trick->getTitle())],
                'flashes'
            ));

            return $this->redirectToRoute('app_trick', [
                '_fragment' => 'tricks'
            ]);
        }

        $this->addFlash('error', $translator->trans(
            'trick.image.error',
            ['error.message' => $featuredImageForm->getErrors(true)->current()->getMessage()],
            'flashes'
        ));

        return $this->redirectToRoute('app_trick_show', [
            'slug' => $trick->getSlug()
        ]);
    }

    /**
     * @throws NonUniqueResultException
     */
    #[Route('/trick/{slug}', name: 'app_trick_show')]
    public function show(string $slug, Request $request, EntityManagerInterface $entityManager, TrickRepository $trickRepository): Response
    {
        $trick = $trickRepository->findOneBySlug($slug);
        $featuredImageForm = $this->createForm(MediaFormType::class);

        if (!$trick) {
            throw new NotFoundHttpException('Trick not found');
        }

        $comment = new Comment();
        $commentForm = $this->createForm(CommentFormType::class, $comment);
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
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
            'commentForm' => $commentForm->createView(),
            'featuredImageForm' => $featuredImageForm->createView()
        ]);
    }

    private function addImages(array $uploadedFiles, UploaderHelper $uploaderHelper, Trick $trick): void
    {
        foreach ($uploadedFiles as $uploadedFile) {
            $this->addImage($uploadedFile, $uploaderHelper, $trick);
        }
    }

    private function addImage(File $uploadedFile, UploaderHelper $uploaderHelper, Trick $trick): Media
    {
        $newFilename = $uploaderHelper->uploadTrickImage($uploadedFile, $trick->getTitle());
        $media = new Media();
        $media->setFile($newFilename)->setType(array_search('image', Media::TYPE));
        $trick->addMedia($media);

        return $media;
    }
}
