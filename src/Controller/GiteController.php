<?php

namespace App\Controller;

use App\Entity\Gite;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GiteController extends AbstractController
{
    #[Route('/gite/{nom}', name: 'gite')]
    public function showGite(Gite $gite): Response
    {

        return $this->render('gite/index.html.twig', [
            'gite' => $gite,
        ]);
    }
}
