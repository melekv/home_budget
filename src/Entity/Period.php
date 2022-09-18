<?php

namespace App\Entity;

use App\Repository\PeriodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PeriodRepository::class)]
#[UniqueEntity('name')]
class Period
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 3,
        max: 50
    )]
    private ?string $name = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Range(
        min: 0,
        max: 1000000
    )]
    private ?float $income = null;

    #[ORM\OneToMany(mappedBy: 'period', targetEntity: MonthlyPlan::class)]
    private Collection $monthlyPlansPeriod;

    #[ORM\OneToMany(mappedBy: 'period', targetEntity: Expense::class)]
    private Collection $expenses;

    public function __construct()
    {
        $this->monthlyPlansPeriod = new ArrayCollection();
        $this->expenses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIncome(): ?float
    {
        return $this->income;
    }

    public function setIncome(float $income): self
    {
        $this->income = $income;

        return $this;
    }

    /**
     * @return Collection<int, MonthlyPlan>
     */
    public function getmonthlyPlansPeriod(): Collection
    {
        return $this->monthlyPlansPeriod;
    }

    public function addMonthlyPlan(MonthlyPlan $monthlyPlan): self
    {
        if (!$this->monthlyPlansPeriod->contains($monthlyPlan)) {
            $this->monthlyPlansPeriod->add($monthlyPlan);
            $monthlyPlan->setPeriod($this);
        }

        return $this;
    }

    public function removeMonthlyPlan(MonthlyPlan $monthlyPlan): self
    {
        if ($this->monthlyPlansPeriod->removeElement($monthlyPlan)) {
            // set the owning side to null (unless already changed)
            if ($monthlyPlan->getPeriod() === $this) {
                $monthlyPlan->setPeriod(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Expense>
     */
    public function getExpenses(): Collection
    {
        return $this->expenses;
    }

    public function addExpense(Expense $expense): self
    {
        if (!$this->expenses->contains($expense)) {
            $this->expenses->add($expense);
            $expense->setPeriod($this);
        }

        return $this;
    }

    public function removeExpense(Expense $expense): self
    {
        if ($this->expenses->removeElement($expense)) {
            // set the owning side to null (unless already changed)
            if ($expense->getPeriod() === $this) {
                $expense->setPeriod(null);
            }
        }

        return $this;
    }
}
