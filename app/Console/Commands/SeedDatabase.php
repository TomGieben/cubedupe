<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeedDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        Artisan::call('db:seed', ['--class' => 'BiomesSeeder']);
        Artisan::call('db:seed', ['--class' => 'BlocksSeeder']);
        Artisan::call('db:seed', ['--class' => 'ItemsSeeder']);
        Artisan::call('db:seed', ['--class' => 'BlockBiomeSeeder']);
        Artisan::call('db:seed', ['--class' => 'BlockItemSeeder']);
    }
}
