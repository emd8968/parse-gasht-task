<?php

namespace App\Services;

use App\Repositories\CountryRepository;

class CountriesService
{

    public function __construct(
        private readonly CountryRepository $countryRepository
    )
    {

    }

    public function getAll()
    {
        return $this->countryRepository->all();
    }

}
