<?php

namespace App\Entity;

use App\Repository\ExpenseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExpenseRepository::class)]
// #[ORM\AssociationOverrides([
//     new ORM\AssociationOverride(
//         name: 'monthlyPlan',
//         joinColumns: [
//             new ORM\JoinColumn(name: 'period_id', referencedColumnName: 'period'),
//             new ORM\JoinColumn(name: 'category_id', referencedColumnName: 'category')
//         ]
//     )
// ])]
class Expense
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'expenses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Period $period = null;

    #[ORM\ManyToOne(inversedBy: 'expenses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\Column]
    private ?int $amount = null;

    #[ORM\ManyToOne(inversedBy: 'expenses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MonthlyPlan $monthlyPlan = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPeriod(): ?Period
    {
        return $this->period;
    }

    public function setPeriod(?Period $period): self
    {
        $this->period = $period;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getMonthlyPlan(): ?MonthlyPlan
    {
        return $this->monthlyPlan;
    }

    public function setMonthlyPlan(?MonthlyPlan $monthlyPlan): self
    {
        $this->monthlyPlan = $monthlyPlan;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }
}
