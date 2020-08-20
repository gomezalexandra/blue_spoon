<?php


namespace App\Object;


class IncomeStatement
{
    private $turnover1;
    private $turnover2;
    private $variableCost1;
    private $variableCost2;


    public function getTurnover1()
    {
        return $this->turnover1;
    }

    public function getTurnover2()
    {
        return $this->turnover2;
    }

    public function getVariableCost1()
    {
        return $this->variableCost1;
    }

    public function getVariableCost2()
    {
        return $this->variableCost2;
    }

    public function calculate($turnover, $cost) {
        $this->turnover1 = ($turnover->getMonthWorked())*($turnover->getDaysWorked())*($turnover->getDailyRevenue());
        $this->turnover2 = $this->turnover1*($turnover->getTurnoverIncrease());
        $this->variableCosts1 = $this->turnover1 * ($cost->getVariableCosts());
        $this->variableCosts2 = $this->turnover2 * ($cost->getVariableCosts());
    }


}