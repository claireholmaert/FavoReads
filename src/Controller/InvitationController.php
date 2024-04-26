<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Invitation;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class InvitationController extends AbstractController
{
    public function __construct(
        private readonly UserPasswordHasherInterface $userPasswordHasher, 
        private readonly EntityManagerInterface $entityManager
        )
    {
        
    }

    #[Route('/invitation/{uuid}', 
    name: 'invitation_index')]
    public function index(
        Invitation $invitation,
        Request $request,
        ): Response
    {
        if($invitation->getReader() !== null) {
            throw new Exception('This invitation has already been used!');
        }

        $user = new User();
        $user->setEmail($invitation->getEmail());
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $this->userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $invitation->setReader($user);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('admin');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
