<?php

namespace App\Http\Controllers;

use App\Http\Resources\CurrencyResource;
use App\Services\CurrenciesService;

class CurrencyController extends Controller
{
    public function __construct(
        private readonly CurrenciesService $currenciesService
    )
    {
    }

    public function index()
    {
        $currencies = $this->currenciesService->getAll();
        return CurrencyResource::collection($currencies);
    }
}
