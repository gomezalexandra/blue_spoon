<?php

namespace App\Entity;

use App\Repository\FirstNeedsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FirstNeedsRepository::class)
 */
class FirstNeeds
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Simulation::class, inversedBy="firstNeeds", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $simulation;

    /**
     * @ORM\Column(type="integer")
     */
    private $starting_cash;

    /**
     * @ORM\Column(type="integer")
     */
    private $starting_investment;

    /**
     * @ORM\Column(type="integer")
     */
    private $depreciation;

    /**
     * @ORM\Column(type="integer")
     */
    private $starting_stock;

    /**
     * @ORM\Column(type="integer")
     */
    private $others_needs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSimulation(): ?Simulation
    {
        return $this->simulation;
    }

    public function setSimulation(Simulation $simulation): self
    {
        $this->simulation = $simulation;

        return $this;
    }

    public function getStartingCash(): ?int
    {
        return $this->starting_cash;
    }

    public function setStartingCash(int $starting_cash): self
    {
        $this->starting_cash = $starting_cash;

        return $this;
    }

    public function getStartingInvestment(): ?int
    {
        return $this->starting_investment;
    }

    public function setStartingInvestment(int $starting_investment): self
    {
        $this->starting_investment = $starting_investment;

        return $this;
    }

    public function getDepreciation(): ?int
    {
        return $this->depreciation;
    }

    public function setDepreciation(int $depreciation): self
    {
        $this->depreciation = $depreciation;

        return $this;
    }

    public function getStartingStock(): ?int
    {
        return $this->starting_stock;
    }

    public function setStartingStock(int $starting_stock): self
    {
        $this->starting_stock = $starting_stock;

        return $this;
    }

    public function getOthersNeeds(): ?int
    {
        return $this->others_needs;
    }

    public function setOthersNeeds(int $others_needs): self
    {
        $this->others_needs = $others_needs;

        return $this;
    }
}
