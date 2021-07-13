<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CurrencyConversion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:convert {--from=eur : The base currency} {--to=usd : The target currency}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Getting the factor between two currencies.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $from = $this->option('from');
        $to = $this->option('to');

        $response = Http::get("https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@1/latest/currencies/{$from}/{$to}.json")
            ->object();

        $this->info('Petición realizada.');
        $this->info($response->$to);

        Log::info($response->$to);

        return 0;
    }
}
