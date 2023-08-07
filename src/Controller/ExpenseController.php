<?php

namespace App\Controller;

use App\Entity\Expense;
use App\Entity\ExpenseType as Type;
use App\Form\ExpenseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExpenseController extends AbstractController
{
    #[Route('/expense/add', name: 'expense_add')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $expense = new Expense();
        $expense->setDate(new \DateTime('now'));
        $expense->setType(Type::Outcome);

        $form = $this->createForm(ExpenseType::class, $expense);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $expense = $form->getData();

            $entityManager->persist($expense);
            $entityManager->flush();

            return $this->redirectToRoute('app_index');
        }

        return $this->render('expense/add.html.twig', [
            'form' => $form
        ]);
    }
}
