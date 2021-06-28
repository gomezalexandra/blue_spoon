<?php


namespace App\Service;


use App\Repository\CostsRepository;
use App\Repository\FirstNeedsRepository;
use App\Repository\IncomesRepository;
use App\Repository\TurnoverRepository;

class IncomeStatement
{
    private $turnoverRepository;
    private $costsRepository;
    private $firstNeedsRepository;
    private $incomesRepository;

    public function __construct(TurnoverRepository $turnoverRepository, CostsRepository $costsRepository, FirstNeedsRepository $firstNeedsRepository, IncomesRepository  $incomesRepository)
    {
        $this->turnoverRepository = $turnoverRepository;
        $this->costsRepository = $costsRepository;
        $this->firstNeedsRepository = $firstNeedsRepository;
        $this->incomesRepository = $incomesRepository;
    }

    public function calculate($slug) {
        $turnover = $this->turnoverRepository->findOneBy(['simulation' => $slug]);
        $cost = $this->costsRepository->findOneBy(['simulation' => $slug]);
        $needs = $this->firstNeedsRepository->findOneBy(['simulation' => $slug]);
        $incomes = $this->incomesRepository->findOneBy(['simulation' => $slug]);

        $firstNeeds = $needs->getStartingCash() + $needs->getStartingInvestment() + $needs->getStartingStock() + $needs->getOthersNeeds();
        $contribution = $incomes->getBankLoan() + $incomes->getPersonnalContribution() + $incomes->getContributionInKind() + $incomes->getStartingGrant() + $incomes->getOthersIncomes() ;

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

        $resultBeforeTax1 = $businessResult1 - 0;
        $resultBeforeTax2 = $businessResult2 - 0;
        $resultBeforeTax3 = $businessResult3 - 0;

        if ($resultBeforeTax1 > 0){
            $corporateTaxes1 = ($cost->getCorporationTax())*$resultBeforeTax1;
        } else {
            $corporateTaxes1 = 0;
        }
        if ($resultBeforeTax1 > 0){
            $corporateTaxes2 = ($cost->getCorporationTax())*$resultBeforeTax2;
        } else {
            $corporateTaxes2 = 0;
        }
        if ($resultBeforeTax1 > 0){
            $corporateTaxes3 = ($cost->getCorporationTax())*$resultBeforeTax3;
        } else {
            $corporateTaxes3 = 0;
        }

        $revenue1 = $resultBeforeTax1 - $corporateTaxes1;
        $revenue2 = $resultBeforeTax2 - $corporateTaxes2;
        $revenue3 = $resultBeforeTax3 - $corporateTaxes3;


            return [
            'firstNeeds' => $firstNeeds,
            'contribution' => $contribution,
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
            'resultBeforeTax1' => $resultBeforeTax1,
            'resultBeforeTax2' => $resultBeforeTax2,
            'resultBeforeTax3' => $resultBeforeTax3,
            'corporateTaxes1' => $corporateTaxes1,
            'corporateTaxes2' => $corporateTaxes2,
            'corporateTaxes3' => $corporateTaxes3,
            'revenue1' => $revenue1,
            'revenue2' => $revenue2,
            'revenue3' => $revenue3,
        ];
    }
}