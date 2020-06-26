<?php

namespace App\Controller;

use App\Entity\Quest;
use App\Entity\Success;
use App\Entity\User;
use App\Entity\Character;
use App\Services\QuestManager;
use App\Services\ExpManager;
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
    public function index(QuestManager $qm, ValidationRepository $vr, ExpManager $xp): Response
    {
        $dailyquest = $this->getDoctrine()
        ->getRepository(Quest::class)
        ->findBy(
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
        $limitquest = $this->getDoctrine()
        ->getRepository(Quest::class)
        ->findBy(
            ['type' => 2],null,3
        );


        $userid = $user->getId();

        $personalquest = $this->getDoctrine()
        ->getRepository(Quest::class)
        ->findPersonnalQuestsByUser($userid);

        $valid = $this->getDoctrine()
        ->getRepository(Quest::class)
        ->findAllValid($userid);

        $validquests = [];
        foreach ($valid as $validquest)
        {
            $validquests[] = $validquest->getId();
        }

        $successes = $user->getsuccesses();
        $avatar = $user->getAvatar();

        $level = $xp->getLevel($avatar->getTotalExp());
        return $this->render('dashboard/index.html.twig', [
            'successes'=>$successes,
            'user' => $user,
            'dailys' =>$dailyquest,
            'limits' => $limitquest,
            'personals' => $personalquest,
            'valid' => $validquests,
            'character' => $avatar,
            'level' => $level
        ]);
    }
}
