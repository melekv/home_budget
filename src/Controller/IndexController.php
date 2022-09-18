<?php

namespace App\Controller;

use App\Entity\Period;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $periods = $doctrine->getRepository(Period::class)->findAll();

        return $this->render('index/index.html.twig', [
            'periods' => $periods
        ]);
    }
}
