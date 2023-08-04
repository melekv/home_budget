<?php

namespace App\Entity;

use App\Repository\CategoryPeriodRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryPeriodRepository::class)]
class CategoryPeriod
{
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[ORM\Id]
    private ?Category $category = null;

    #[ORM\ManyToOne(
        targetEntity: 'Period',
        inversedBy: 'categoryPeriod'
    )]
    #[ORM\JoinColumn(nullable: false)]
    #[ORM\Id]
    private ?Period $period = null;

    #[ORM\Column(type: Types::FLOAT)]
    private float $amount = 0.0;

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getPeriod(): ?Period
    {
        return $this->period;
    }

    public function setPeriod(?Period $period): static
    {
        $this->period = $period;

        return $this;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }
}
