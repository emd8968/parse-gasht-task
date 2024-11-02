<?php

namespace App\Console\Commands;

use App\Services\RestCountriesService;
use Illuminate\Console\Command;

class PopulateCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate-countries {--truncate : Truncates countries table before inserting new data} {--upsert : Upserts data by country cca3}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    public function __construct(
        private readonly RestCountriesService $restCountriesService
    ){
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->restCountriesService->populateCountiesTable($this->option('truncate'),$this->option('upsert'));
    }
}
