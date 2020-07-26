<?php

namespace App\Entity;

use App\Repository\IncomesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IncomesRepository::class)
 */
class Incomes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Simulation::class, inversedBy="incomes", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $simulation;

    /**
     * @ORM\Column(type="integer")
     */
    private $bank_loan;

    /**
     * @ORM\Column(type="integer")
     */
    private $personnal_contribution;

    /**
     * @ORM\Column(type="integer")
     */
    private $contribution_in_kind;

    /**
     * @ORM\Column(type="integer")
     */
    private $starting_grant;

    /**
     * @ORM\Column(type="integer")
     */
    private $others_incomes;

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

    public function getBankLoan(): ?int
    {
        return $this->bank_loan;
    }

    public function setBankLoan(int $bank_loan): self
    {
        $this->bank_loan = $bank_loan;

        return $this;
    }

    public function getPersonnalContribution(): ?int
    {
        return $this->personnal_contribution;
    }

    public function setPersonnalContribution(int $personnal_contribution): self
    {
        $this->personnal_contribution = $personnal_contribution;

        return $this;
    }

    public function getContributionInKind(): ?int
    {
        return $this->contribution_in_kind;
    }

    public function setContributionInKind(int $contribution_in_kind): self
    {
        $this->contribution_in_kind = $contribution_in_kind;

        return $this;
    }

    public function getStartingGrant(): ?int
    {
        return $this->starting_grant;
    }

    public function setStartingGrant(int $starting_grant): self
    {
        $this->starting_grant = $starting_grant;

        return $this;
    }

    public function getOthersIncomes(): ?int
    {
        return $this->others_incomes;
    }

    public function setOthersIncomes(int $others_incomes): self
    {
        $this->others_incomes = $others_incomes;

        return $this;
    }
}
