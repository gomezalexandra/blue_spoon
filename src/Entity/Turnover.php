<?php

namespace App\Entity;

use App\Repository\TurnoverRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TurnoverRepository::class)
 */
class Turnover
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Simulation::class, inversedBy="turnover", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $simulation;

    /**
     * @ORM\Column(type="integer")
     */
    private $month_worked;

    /**
     * @ORM\Column(type="integer")
     */
    private $days_worked;

    /**
     * @ORM\Column(type="integer")
     */
    private $daily_revenue;

    /**
     * @ORM\Column(type="integer")
     */
    private $turnover_increase;

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

    public function getMonthWorked(): ?int
    {
        return $this->month_worked;
    }

    public function setMonthWorked(int $month_worked): self
    {
        $this->month_worked = $month_worked;

        return $this;
    }

    public function getDaysWorked(): ?int
    {
        return $this->days_worked;
    }

    public function setDaysWorked(int $days_worked): self
    {
        $this->days_worked = $days_worked;

        return $this;
    }

    public function getDailyRevenue(): ?int
    {
        return $this->daily_revenue;
    }

    public function setDailyRevenue(int $daily_revenue): self
    {
        $this->daily_revenue = $daily_revenue;

        return $this;
    }

    public function getTurnoverIncrease(): ?int
    {
        return $this->turnover_increase;
    }

    public function setTurnoverIncrease(int $turnover_increase): self
    {
        $this->turnover_increase = $turnover_increase;

        return $this;
    }
}
