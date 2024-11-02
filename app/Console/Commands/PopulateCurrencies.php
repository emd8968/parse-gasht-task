<?php

namespace App\Console\Commands;

use App\Services\RestCountriesService;
use Illuminate\Console\Command;

class PopulateCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate-currencies {--truncate : Truncates currencies table before inserting new data} {--upsert : Upserts data by currency abbreviate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct(
        private readonly RestCountriesService $restCountriesService
    )
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->restCountriesService->populateCurrenciesTable($this->option('truncate'), $this->option('upsert'));
    }
}
