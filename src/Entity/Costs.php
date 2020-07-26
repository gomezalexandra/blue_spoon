<?php

namespace App\Entity;

use App\Repository\CostsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CostsRepository::class)
 */
class Costs
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Simulation::class, inversedBy="costs", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $simulation;

    /**
     * @ORM\Column(type="integer")
     */
    private $salaries;

    /**
     * @ORM\Column(type="integer")
     */
    private $salaries_increase;

    /**
     * @ORM\Column(type="integer")
     */
    private $rent;

    /**
     * @ORM\Column(type="integer")
     */
    private $insurance;

    /**
     * @ORM\Column(type="integer")
     */
    private $others_fixed_costs;

    /**
     * @ORM\Column(type="integer")
     */
    private $variable_costs;

    /**
     * @ORM\Column(type="integer")
     */
    private $taxes;

    /**
     * @ORM\Column(type="integer")
     */
    private $corporation_tax;

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

    public function getSalaries(): ?int
    {
        return $this->salaries;
    }

    public function setSalaries(int $salaries): self
    {
        $this->salaries = $salaries;

        return $this;
    }

    public function getSalariesIncrease(): ?int
    {
        return $this->salaries_increase;
    }

    public function setSalariesIncrease(int $salaries_increase): self
    {
        $this->salaries_increase = $salaries_increase;

        return $this;
    }

    public function getRent(): ?int
    {
        return $this->rent;
    }

    public function setRent(int $rent): self
    {
        $this->rent = $rent;

        return $this;
    }

    public function getInsurance(): ?int
    {
        return $this->insurance;
    }

    public function setInsurance(int $insurance): self
    {
        $this->insurance = $insurance;

        return $this;
    }

    public function getOthersFixedCosts(): ?int
    {
        return $this->others_fixed_costs;
    }

    public function setOthersFixedCosts(int $others_fixed_costs): self
    {
        $this->others_fixed_costs = $others_fixed_costs;

        return $this;
    }

    public function getVariableCosts(): ?int
    {
        return $this->variable_costs;
    }

    public function setVariableCosts(int $variable_costs): self
    {
        $this->variable_costs = $variable_costs;

        return $this;
    }

    public function getTaxes(): ?int
    {
        return $this->taxes;
    }

    public function setTaxes(int $taxes): self
    {
        $this->taxes = $taxes;

        return $this;
    }

    public function getCorporationTax(): ?int
    {
        return $this->corporation_tax;
    }

    public function setCorporationTax(int $corporation_tax): self
    {
        $this->corporation_tax = $corporation_tax;

        return $this;
    }
}
