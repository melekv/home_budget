<?php

namespace App\Controller;

use App\Entity\MonthlyPlan;
use App\Entity\Period;
use App\Form\PeriodType;
use App\Repository\PeriodRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PeriodController extends AbstractController
{
    #[Route('/period/add', name: 'period_add')]
    public function create(Request $request, PeriodRepository $pr): Response
    {
        $period = new Period();

        $form = $this->createForm(PeriodType::class, $period);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $period = $form->getData();
            $pr->add($period, true);

            return $this->redirectToRoute('index');
        }

        return $this->renderForm('period/add.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/period/{id}/edit', name: 'period_edit')]
    public function update(int $id, Request $request, PeriodRepository $pr): Response
    {
        $period = $pr->find($id);

        $form = $this->createForm(PeriodType::class, $period);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $period = $form->getData();
            $pr->add($period, true);

            return $this->redirectToRoute('index');
        }

        return $this->renderForm('period/add.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/period/{id}/delete', name: 'period_delete')]
    public function delete(int $id, PeriodRepository $pr): RedirectResponse
    {
        $period = $pr->find($id);
        $pr->remove($period, true);

        return $this->redirectToRoute('index');
    }

    #[Route('/period/{id}', name: 'period')]
    public function period(string $id, ManagerRegistry $doctrine): Response
    {
        $period = $doctrine->getRepository(Period::class)->find($id);

        $budget = $doctrine->getRepository(MonthlyPlan::class)->findBy([
            'period' => $period->getId()
        ]);

        return $this->render('period/period.html.twig', [
            'budget' => $budget,
            'period' => $period
        ]);
    }
}
