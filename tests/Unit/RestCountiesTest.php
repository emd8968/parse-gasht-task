<?php


use \Illuminate\Foundation\Testing\TestCase;
use \Illuminate\Foundation\Testing\RefreshDatabase;

class RestCountiesTest extends TestCase
{

    public static function setUpBeforeClass(): void
    {
        echo shell_exec('php artisan migrate:fresh');
    }

    public function test_populate_countries(): void
    {
        $restCountriesService = app()->make(\App\Services\RestCountriesService::class);

        $restCountriesService->populateCountiesTable();

        $this->assertGreaterThan(0, \App\Models\Country::query()->count());
    }

    public function test_populate_currencies(): void
    {
        $restCountriesService = app()->make(\App\Services\RestCountriesService::class);

        $restCountriesService->populateCurrenciesTable();

        $this->assertGreaterThan(0, \App\Models\Currency::query()->count());
    }
}
