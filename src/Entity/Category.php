<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: MonthlyPlan::class)]
    private Collection $monthlyPlansCategory;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Expense::class)]
    private Collection $expenses;

    public function __construct()
    {
        $this->monthlyPlansCategory = new ArrayCollection();
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

    /**
     * @return Collection<int, MonthlyPlan>
     */
    public function getMonthlyPlansCategory(): Collection
    {
        return $this->monthlyPlansCategory;
    }

    public function addMonthlyPlansCategory(MonthlyPlan $monthlyPlansCategory): self
    {
        if (!$this->monthlyPlansCategory->contains($monthlyPlansCategory)) {
            $this->monthlyPlansCategory->add($monthlyPlansCategory);
            $monthlyPlansCategory->setCategory($this);
        }

        return $this;
    }

    public function removeMonthlyPlansCategory(MonthlyPlan $monthlyPlansCategory): self
    {
        if ($this->monthlyPlansCategory->removeElement($monthlyPlansCategory)) {
            // set the owning side to null (unless already changed)
            if ($monthlyPlansCategory->getCategory() === $this) {
                $monthlyPlansCategory->setCategory(null);
            }
        }

        return $this;
    }
}
