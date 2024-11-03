<?php

namespace App\Services;

use App\Repositories\CurrencyRepository;

class CurrenciesService
{

    public function __construct(
        private readonly CurrencyRepository $currencyRepository
    )
    {

    }

    public function getAll()
    {
        return $this->currencyRepository->all();
    }

}
