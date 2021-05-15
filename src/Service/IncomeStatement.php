<?php


namespace App\Service;


use App\Repository\CostsRepository;
use App\Repository\TurnoverRepository;

class IncomeStatement
{
    private $turnoverRepository;
    private $costsRepository;

    public function __construct(TurnoverRepository $turnoverRepository, CostsRepository $costsRepository)
    {
        $this->turnoverRepository = $turnoverRepository;
        $this->costsRepository = $costsRepository;
    }

    public function calculate($slug) {
        $turnover = $this->turnoverRepository->findOneBy(['simulation' => $slug]);
        $cost = $this->costsRepository->findOneBy(['simulation' => $slug]);

        $turnover1 = ($turnover->getMonthWorked())*($turnover->getDaysWorked())*($turnover->getDailyRevenue());
        $turnover2 = $turnover1*($turnover->getTurnoverIncrease());
        $turnover3 = $turnover2*($turnover->getTurnoverIncrease());
        $variableCosts1 = $turnover1 * ($cost->getVariableCosts());
        $variableCosts2 = $turnover2 * ($cost->getVariableCosts());
        $variableCosts3 = $turnover3 * ($cost->getVariableCosts());
        $taxes1 = ($cost->getTaxes())*$turnover1;
        $taxes2 = ($cost->getTaxes())*$turnover2;
        $taxes3 = ($cost->getTaxes())*$turnover3;
        $salary1 = $cost->getSalaries();
        $salary2 = $salary1 * ($cost->getSalariesIncrease());
        $salary3 = $salary2 * ($cost->getSalariesIncrease());
        $totalCosts1 = $variableCosts1 + $taxes1 + $salary1 + ($cost->getInsurance()) + ($cost->getRent()) + ($cost->getOthersFixedCosts());
        $totalCosts2 = $variableCosts2 + $taxes2 + $salary2 + ($cost->getInsurance()) + ($cost->getRent()) + ($cost->getOthersFixedCosts());
        $totalCosts3 = $variableCosts3 + $taxes3 + $salary3 + ($cost->getInsurance()) + ($cost->getRent()) + ($cost->getOthersFixedCosts());
        $businessResult1 =$turnover1 - $totalCosts1;
        $businessResult2 =$turnover2 - $totalCosts2;
        $businessResult3 =$turnover3 - $totalCosts3;
        $corporateTaxes1 = ($cost->getCorporationTax())*$turnover1;
        $corporateTaxes2 = ($cost->getCorporationTax())*$turnover2;
        $corporateTaxes3 = ($cost->getCorporationTax())*$turnover3;

        return [
            'turnover' => $turnover,
            'cost' => $cost,
            'turnover1' => $turnover1,
            'turnover2' => $turnover2,
            'turnover3' => $turnover3,
            'variableCosts1' => $variableCosts1,
            'variableCosts2' => $variableCosts2,
            'variableCosts3' => $variableCosts3,
            'taxes1' => $taxes1,
            'taxes2' => $taxes2,
            'taxes3' => $taxes3,
            'salary1' => $salary1,
            'salary2' => $salary2,
            'salary3' => $salary3,
            'totalCosts1' => $totalCosts1,
            'totalCosts2' => $totalCosts2,
            'totalCosts3' => $totalCosts3,
            'businessResult1' => $businessResult1,
            'businessResult2' => $businessResult2,
            'businessResult3' => $businessResult3,
            'corporateTaxes1' => $corporateTaxes1,
            'corporateTaxes2' => $corporateTaxes2,
            'corporateTaxes3' => $corporateTaxes3,
        ];
    }


}