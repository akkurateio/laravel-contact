<?php

namespace Akkurate\LaravelContact\Console;

use Illuminate\Console\Command;

class ContactSeed extends Command
{
    protected $signature = 'contact:seed';
    protected $description = 'Seed the Contact package from the config file';

    public function handle()
    {
        $this->call('db:seed', [
            '--class' => 'Akkurate\\LaravelContact\\Database\\Seeders\\DatabaseSeeder'
        ]);
    }
}
