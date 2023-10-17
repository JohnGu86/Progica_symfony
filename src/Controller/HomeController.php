<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Repository\GiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(GiteRepository $giteRepository, Request $request): Response
    {

        
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);
        
        $gites = [];
        
        if($form->isSubmitted() && $form->isValid()) {
            
            $criteria = $form->getData();

            $gites = $giteRepository->findGiteByCriteria($criteria);

            return $this->render('home/results.html.twig', ['form' => $form, 'gites' => $gites]);
            
        }
        
        $gites = $giteRepository->findAll();

        return $this->render('home/index.html.twig', [
            'gites' => $gites,
            'form' => $form 
        ]);
    }
}

