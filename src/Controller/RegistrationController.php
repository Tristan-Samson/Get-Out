<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Character;
use App\Entity\Quest;
use App\Entity\Validation;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);

            $character = new Character();
            $character->setUser($user);
            $character->setTotalExp(0);
            $character->setHealth(50);
            $character->setAttack(10);
            $entityManager->persist($character);

            $quests = $this->getDoctrine()
            ->getRepository(Quest::class)
            ->findAll();

            foreach ($quests as $quest)
            {
                $validation = new Validation();
                $currentDate = new \DateTime("now");
                $validation->setValidationDate($currentDate);
                $validation->setUserId($user);
                $validation->setQuests($quest);
                $validation->setIsValid(false);
                $entityManager->persist($validation);
            }

            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
