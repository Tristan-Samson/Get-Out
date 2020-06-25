<?php

namespace App\Controller;

use App\Entity\Quest;
use App\Entity\Success;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard_index", methods={"GET"})
     * @return Response
     */
    public function index(): Response
    {
        $dailyquest = $this->getDoctrine()->getRepository(Quest::class)->findBy(
            ['type' => 1],null,3
        );
        $limitquest = $this->getDoctrine()->getRepository(Quest::class)->findBy(
            ['type' => 2],null,3
        );
        $personalquest = $this->getDoctrine()->getRepository(Quest::class)->findBy(
            ['type' => 3],null,3
        );


        $user = $this->getUser();
        return $this->render('dashboard/index.html.twig', [
            'user' => $user,
            'dailys' =>$dailyquest,
            'limits' => $limitquest,
            'personals' => $personalquest,
        ]);
    }
}
