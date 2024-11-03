<?php

namespace App\Http\Controllers;

use App\Http\Resources\CountryResource;
use App\Services\CountriesService;

class CountryController extends Controller
{
    public function __construct(
        private readonly CountriesService $countriesService
    )
    {
    }

    public function index()
    {
        $countries = $this->countriesService->getAll();
        return CountryResource::collection($countries);
    }
}
