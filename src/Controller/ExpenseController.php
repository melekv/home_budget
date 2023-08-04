<?php

namespace App\Controller;

use App\Entity\Expense;
use App\Entity\MonthlyPlan;
use App\Entity\Period;
use App\Form\ExpenseType;
use App\Repository\ExpenseRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExpenseController extends AbstractController
{
    #[Route('period/{periodId}/expense/add', name: 'expense_add')]
    public function create(
        int $periodId,
        Request $request,
        ManagerRegistry $doctrine,
        ExpenseRepository $er
        ): Response
    {
        $expense = new Expense();
        
        $period = $doctrine->getRepository(Period::class)->find($periodId);
        $expense->setPeriod($period);

        $form = $this->createForm(ExpenseType::class, $expense);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $expense = $form->getData();

            $monthlyPlan = $doctrine->getRepository(MonthlyPlan::class)->findOneBy([
                'period' => $expense->getPeriod(),
                'category' => $expense->getCategory()
            ]);
            
            if (!$monthlyPlan) {
                $this->addFlash(
                    'notice',
                    'Brakuje kategorii: ' .$expense->getCategory()->getName() . '!'
                );

                return $this->redirectToRoute('expense_add', [
                    'periodId' => $periodId
                ]);
            }

            $expense->setMonthlyPlan($monthlyPlan);

            $er->add($expense, true);

            return $this->redirectToRoute('period', [
                'id' => $periodId
            ]);
        }

        return $this->renderForm('expense/add.html.twig', [
            'form' => $form
        ]);
    }
}
