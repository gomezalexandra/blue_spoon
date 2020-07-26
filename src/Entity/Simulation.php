<?php

namespace App\Entity;

use App\Repository\SimulationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SimulationRepository::class)
 */
class Simulation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="simulations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="boolean")
     */
    private $state;

    /**
     * @ORM\OneToOne(targetEntity=FirstNeeds::class, mappedBy="simulation", cascade={"persist", "remove"})
     */
    private $firstNeeds;

    /**
     * @ORM\OneToOne(targetEntity=Incomes::class, mappedBy="simulation", cascade={"persist", "remove"})
     */
    private $incomes;

    /**
     * @ORM\OneToOne(targetEntity=Turnover::class, mappedBy="simulation", cascade={"persist", "remove"})
     */
    private $turnover;

    /**
     * @ORM\OneToOne(targetEntity=Costs::class, mappedBy="simulation", cascade={"persist", "remove"})
     */
    private $costs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getState(): ?bool
    {
        return $this->state;
    }

    public function setState(bool $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getFirstNeeds(): ?FirstNeeds
    {
        return $this->firstNeeds;
    }

    public function setFirstNeeds(FirstNeeds $firstNeeds): self
    {
        $this->firstNeeds = $firstNeeds;

        // set the owning side of the relation if necessary
        if ($firstNeeds->getSimulation() !== $this) {
            $firstNeeds->setSimulation($this);
        }

        return $this;
    }

    public function getIncomes(): ?Incomes
    {
        return $this->incomes;
    }

    public function setIncomes(Incomes $incomes): self
    {
        $this->incomes = $incomes;

        // set the owning side of the relation if necessary
        if ($incomes->getSimulation() !== $this) {
            $incomes->setSimulation($this);
        }

        return $this;
    }

    public function getTurnover(): ?Turnover
    {
        return $this->turnover;
    }

    public function setTurnover(Turnover $turnover): self
    {
        $this->turnover = $turnover;

        // set the owning side of the relation if necessary
        if ($turnover->getSimulation() !== $this) {
            $turnover->setSimulation($this);
        }

        return $this;
    }

    public function getCosts(): ?Costs
    {
        return $this->costs;
    }

    public function setCosts(Costs $costs): self
    {
        $this->costs = $costs;

        // set the owning side of the relation if necessary
        if ($costs->getSimulation() !== $this) {
            $costs->setSimulation($this);
        }

        return $this;
    }
}
