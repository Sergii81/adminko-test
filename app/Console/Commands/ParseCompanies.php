<?php

namespace App\Console\Commands;

use App\Interfaces\ClientService\ClientServiceInterface;
use App\Interfaces\ClientService\ParseServiceInterface;
use Exception;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class ParseCompanies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:parse-companies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse companies';

    public function __construct(private readonly ParseServiceInterface $parseService)
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        try {
            $this->parseService->setHeaders();
            $this->parseService->storeUsers();
            $this->parseService->storeCompanies();
            $this->parseService->storePositions();
        } catch (Exception $exception) {

            return CommandAlias::FAILURE;
        }

        return CommandAlias::SUCCESS;
    }
}
