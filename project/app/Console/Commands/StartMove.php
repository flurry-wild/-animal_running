<?php

namespace App\Console\Commands;

use App\Animals\AnimalCollection;
use App\Enclosure\EnclosureCollection;
use App\Services\AnimalService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class StartMove extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start-move';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start animals move';

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
    public function handle(AnimalService $service)
    {
        $service->run(new AnimalCollection(), new EnclosureCollection());

        Log::info('start Move');

        return 0;
    }
}
