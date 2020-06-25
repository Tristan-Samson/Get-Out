<?php

namespace App\Controller;

use App\Entity\User;
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
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('dashboard/index.html.twig', [
            'user' => $user,
        ]);
    }
}
