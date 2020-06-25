<?php

namespace App\Controller;

use App\Entity\Quest;
use App\Entity\Success;
use App\Entity\User;
use App\Services\QuestManager;
use App\Repository\ValidationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/dashboard")
 * @IsGranted("ROLE_USER")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard_index", methods={"GET"})
     * @return Response
     */
    public function index(QuestManager $qm, ValidationRepository $vr): Response
    {
        $dailyquest = $this->getDoctrine()->getRepository(Quest::class)->findBy(
            ['type' => 1],null,3
        );
        $user = $this->getUser();
        foreach ($dailyquest as $quest)
        {
            $validation = $vr->findOneBy(
                [
                    'user_id' => $user->getId(),
                    'quests' => $quest->getId()
                ]
            );
            $qm->resetDailyQuest($validation);

        }
        $limitquest = $this->getDoctrine()->getRepository(Quest::class)->findBy(
            ['type' => 2],null,3
        );
        $personalquest = $this->getDoctrine()->getRepository(Quest::class)->findBy(
            ['type' => 3],null,3
        );

        $user = $this->getUser();
        $successes = $user->getsuccesses();
        return $this->render('dashboard/index.html.twig', [
            'successes'=>$successes,
            'user' => $user,
            'dailys' =>$dailyquest,
            'limits' => $limitquest,
            'personals' => $personalquest,
        ]);
    }
}
