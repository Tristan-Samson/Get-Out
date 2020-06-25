<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('dashboard_index');
        }
        return $this->render('Accueil/index.html.twig', [""
        ]);
    }
}
