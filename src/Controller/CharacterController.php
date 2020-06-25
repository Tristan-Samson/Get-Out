<?php

namespace App\Controller;

use App\Entity\Character;
use App\Form\CharacterType;
use App\Repository\CharacterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/character")
 * @IsGranted("ROLE_USER")
 */
class CharacterController extends AbstractController
{
    /**
     * @Route("/", name="character_index", methods={"GET"})
     */
    /* 
    public function index(CharacterRepository $characterRepository): Response
    {
        return $this->render('character/index.html.twig', [
            'characters' => $characterRepository->findAll(),
        ]);
    } 
    */

    /**
     * @Route("/new", name="character_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $character = new Character();
        $user = $this->getUser();
        if ($user->getAvatar() !== NULL)
        {
            return $this->redirectToRoute('character_show', ['id' => $user->getId()]);
        }

            $entityManager = $this->getDoctrine()->getManager();
            $character->setUser($user);
            $character->setTotalExp(0);
            $character->setHealth(50);
            $character->setAttack(10);
            $entityManager->persist($character);
            $entityManager->flush();

            return $this->redirectToRoute('character_show', ['id' => $user->getId()]);
    }

    /**
     * @Route("/{id}", name="character_show", methods={"GET"})
     */
    public function show(Character $character): Response
    {
        return $this->render('character/show.html.twig', [
            'character' => $character,
        ]);
    }
}
