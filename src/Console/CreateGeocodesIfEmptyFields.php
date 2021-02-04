<?php

namespace App\Console\Commands;

use Akkurate\LaravelContact\Jobs\CreateGeocode;
use Akkurate\LaravelContact\Models\Address;
use Illuminate\Console\Command;

class CreateGeocodesIfEmptyFields extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contact:create-geocodes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tries to create geocodes for empty addresses fields';

    public function handle(): void
    {
        $addresses = Address::whereNull('latitude')->whereNull('longitude')->get();

        if ($addresses->isEmpty()) {
            $this->info('No more addresses without latitude and longitude, you are good.');

            return;
        }

        foreach ($addresses as $address) {
            CreateGeocode::dispatch($address);
        }

        $this->info('Done ! Make sure horizon is running.');
    }
}
