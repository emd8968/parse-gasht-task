<?php

namespace App\Services;

use App\Repositories\CountryRepository;
use App\Repositories\CurrencyRepository;
use Illuminate\Support\Facades\Http;

class RestCountriesService
{

    public function __construct(
        private readonly CountryRepository  $countryRepository,
        private readonly CurrencyRepository $currencyRepository,
    )
    {

    }

    public function fetchAllCountries(): array
    {
        $result = Http::withoutVerifying()->get('https://restcountries.com/v3.1/all');

        return $result->json();
    }

    public function populateCountiesTable($truncate = false, $upsert = false)
    {
        $data = $this->fetchAllCountries();
        $countriesData = [];
        foreach ($data as $country) {
            $countriesData[] = [
                'name' => $country['name']['common'],
                'cca2' => $country['cca2'],
                'cca3' => $country['cca3'],
            ];
        }

        if (count($countriesData)) {
            if ($truncate) {
                $this->countryRepository->truncate();
            }
            if ($upsert) {
                $this->countryRepository->bulkUpsert($countriesData, 'cca3');
            } else {
                $this->countryRepository->bulkInsert($countriesData);
            }
        }
    }

    public function populateCurrenciesTable($truncate = false, $upsert = false)
    {
        $data = $this->fetchAllCountries();

        $currencyByAbbr = [];//this prevents repetitive entries
        $currenciesData = [];
        foreach ($data as $country) {

            if (isset($country['currencies'])) {
                foreach ($country['currencies'] as $key => $currency) {

                    if (!isset($currencyByAbbr[$key])) {
                        $currencyByAbbr[$key] = true;
                        $currenciesData[] = [
                            'name' => $currency['name'],
                            'abbreviate' => $key
                        ];
                    }
                }
            }
        }

        if (count($currenciesData)) {
            if ($truncate) {
                $this->currencyRepository->truncate();
            }
            if ($upsert) {
                $this->currencyRepository->bulkUpsert($currenciesData, 'abbreviate');
            } else {
                $this->currencyRepository->bulkInsert($currenciesData);
            }
        }
    }

}
