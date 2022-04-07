<?php

namespace App\Controller;

use App\Entity\Media;
use App\Entity\User;
use App\Form\MediaFormType;
use App\Repository\MediaRepository;
use App\Repository\UserRepository;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;

/**
 * @method User getUser()
 */
#[IsGranted('IS_AUTHENTICATED_REMEMBERED')]
class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(UserRepository $userRepository): Response
    {
        $user = $userRepository->findOneByIdWithInformations($this->getUser()->getId());
        $avatarForm = $this->createForm(MediaFormType::class);

        return $this->render('account/index.html.twig', [
            'user' => $this->getUser(),
            'avatarForm' => $avatarForm->createView()
        ]);
    }

    #[Route('/account/avatar', name: 'app_avatar_image', methods: ['POST'])]
    public function changeAvatar(Request $request, UploaderHelper $uploaderHelper, EntityManagerInterface $entityManager)
    {
        $media = new Media();
        $avatarForm = $this->createForm(MediaFormType::class, $media);
        $avatarForm->handleRequest($request);

        if ($avatarForm->isSubmitted() && $avatarForm->isValid()) {
            $uploadedFile = $avatarForm['file']->getData();
            $this->addAvatar($uploadedFile, $uploaderHelper, $media);

            $entityManager->persist($media);
            $entityManager->flush();
        }
        return $this->redirectToRoute('app_account');
    }

    #[Route('/account/avatar/confirm-remove', name: 'app_avatar_confirm_remove', methods: ['GET'])]
    public function confirmRemoveAvatar()
    {
        return $this->render('account/delete_avatar_modal.twig');
    }

    #[Route('/account/avatar/remove/{id}', name: 'app_avatar_remove', methods: ['POST'])]
    public function removeAvatar(Media $media, Request $request, MediaRepository $mediaRepository)
    {
        if (!$this->isCsrfTokenValid('delete' . $media->getId(), $request->get('_token'))) {
            throw new InvalidCsrfTokenException();
        }

        $mediaRepository->remove($media);

        return $this->redirectToRoute('app_account');
    }

    private function addAvatar(File $uploadedFile, UploaderHelper $uploaderHelper, Media $media): void
    {
        $newFilename = $uploaderHelper->uploadAvatarImage($uploadedFile, $this->getUser()->getUserIdentifier());
        $media->setFile($newFilename)->setType(array_search('image', Media::TYPE));
        $this->getUser()->setAvatar($media);
    }
}
