<?php

namespace App\Controller;

use App\Repository\ExpenseRepository;
use App\Repository\CategoryRepository;
use App\Form\AddExpenseType;
use App\Entity\Expense;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $category): Response
    {
        $categories = $category->findAll();

        $costArr = [];
        foreach ($categories as $category) {
            array_push($costArr, [
                'name' => $category->getName(),
                'sum' => $category->sumUpExpense()
            ]);
        }

        return $this->render('index/index.html.twig', ['costArr' => $costArr]);
    }

    #[Route('/add', name: 'add_expense')]
    public function add(Request $request, ExpenseRepository $er): Response
    {
        $expense = new Expense();

        $form = $this->createForm(AddExpenseType::class, $expense);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newExpense = $form->getData();

            $er->add($newExpense, true);

            return $this->redirectToRoute('index');
        }

        return $this->renderForm('index/add.html.twig', ['form' => $form]);
    }
}
