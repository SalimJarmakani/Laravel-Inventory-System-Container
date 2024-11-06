<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class WaitForDatabase extends Command
{
    protected $signature = 'db:wait';
    protected $description = 'Wait until the MySQL database is ready';

    public function handle()
    {
        $this->info('Waiting for database connection...');

        while (true) {
            try {
                DB::connection()->getPdo();
                $this->info('Database is ready!');
                break;
            } catch (\Exception $e) {
                $this->info('Waiting...');
                sleep(2); // Retry every 2 seconds
            }
        }
    }
}
