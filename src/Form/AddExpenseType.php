<?php

namespace App\Form;

// use App\Entity\Expense;
// use App\Entity\Category;
// use App\Entity\MonthlyBudget;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddExpenseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cost', MoneyType::class, [
                'label' => 'Koszt',
                'currency' => '',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('date', EntityType::class, [
                'class' => MonthlyBudget::class,
                'choice_label' => 'period',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            // ->add('category', EntityType::class, [
            //     'class' => Category::class,
            //     'choice_label' => 'name',
            //     'attr' => [
            //         'class' => 'form-control'
            //     ]
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Expense::class,
        ]);
    }
}
