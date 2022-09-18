<?php

namespace App\Entity;

use App\Repository\MonthlyPlanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MonthlyPlanRepository::class)]
class MonthlyPlan
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'monthlyPlansPeriod')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Period $period = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'monthlyPlansCategory')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\Column]
    private ?int $amount = null;

    #[ORM\OneToMany(mappedBy: 'monthlyPlan', targetEntity: Expense::class)]
    private Collection $expenses;

    public function __construct()
    {
        $this->expenses = new ArrayCollection();
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

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

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

    public function sumUpExpenses(): ?float
    {
        $expenseSum = 0;
        foreach ($this->expenses as $expense) {
            $expenseSum += $expense->getAmount();
        }

        return $expenseSum;
    }

    public function percent(): ?float
    {
        if ($this->sumUpExpenses() > $this->amount) return 100;
        
        return $this->sumUpExpenses() / $this->amount * 100;
    }

    public function backgroundColor(): ?string
    {
        return $this->percent() < 100 ? '#0d6efd' : '#ff0000';
    }
}
