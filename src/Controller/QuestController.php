<?php

namespace App\Controller;

use App\Entity\Quest;
use App\Form\QuestType;
use App\Repository\QuestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/quest")
 */
class QuestController extends AbstractController
{


    /**
     * @Route("/type/{type}", name="quest_type", methods={"GET"})
     * @param $type
     * @param QuestRepository $questRepository
     * @return Response
     */
    public function questByType($type,QuestRepository $questRepository): Response
    {

        return $this->render('quest/index.html.twig', [
            'quests' => $questRepository->findBy(['type' => $type]),
        ]);
    }


    /**
     * @Route("/new", name="quest_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $quest = new Quest();
        $form = $this->createForm(QuestType::class, $quest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $quest->setType(3);
            $entityManager->persist($quest);
            $entityManager->flush();

            return $this->redirectToRoute('dashboard_index');
        }

        return $this->render('quest/new.html.twig', [
            'quest' => $quest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quest_show", methods={"GET"})
     * @param Quest $quest
     * @return Response
     */
    public function show(Quest $quest): Response
    {
        return $this->render('quest/show.html.twig', [
            'quest' => $quest,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="quest_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Quest $quest): Response
    {
        $form = $this->createForm(QuestType::class, $quest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('quest_index');
        }

        return $this->render('quest/edit.html.twig', [
            'quest' => $quest,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quest_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Quest $quest): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quest->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($quest);
            $entityManager->flush();
        }

        return $this->redirectToRoute('quest_index');
    }
}
