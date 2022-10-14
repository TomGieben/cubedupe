<?php

namespace App\Console\Commands;

use App\Models\World;
use Illuminate\Console\Command;

class CreateWorld extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:world';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command generates a new world.';

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
        World::new();
        
        return 0;
    }
}
