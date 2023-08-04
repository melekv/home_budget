<?php

namespace App\Controller;

use App\Entity\Period;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        $periods = $this->entityManager->getRepository(Period::class)->findAll();

        return $this->render('index/index.html.twig', [
            'periods' => $periods
        ]);
    }
}
