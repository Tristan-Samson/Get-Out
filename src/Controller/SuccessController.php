<?php

namespace App\Controller;

use App\Entity\Success;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SuccessController extends AbstractController
{
    /**
     * @Route("/success", name="success")
     */
    public function index()
    {
        $successes = $this->getDoctrine()
        ->getRepository(Success::class)
        ->findAll();
        return $this->render('success/index.html.twig', [
            "successes" => $successes
        ]);
    }
}
