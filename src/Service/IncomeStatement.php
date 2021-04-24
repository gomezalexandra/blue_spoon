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

        return [
            'turnover' => $turnover,
            'cost' => $cost,
            'turnover1' => $turnover1,
            'turnover2' => $turnover2,
            'turnover3' => $turnover3,
            'variableCosts1' => $variableCosts1,
            'variableCosts2' => $variableCosts2,
            'variableCosts3' => $variableCosts3,
        ];
    }


}