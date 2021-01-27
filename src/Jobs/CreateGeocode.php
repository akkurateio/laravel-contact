<?php

namespace Akkurate\LaravelContact\Jobs;

use Akkurate\LaravelContact\Models\Address;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\RateLimitedMiddleware\RateLimited;

/**
 * Class CreateGeocode
 * @package App\Jobs
 */
class CreateGeocode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Address
     */
    public $address;

    /**
     * @var int
     */
    public $tries = 3;

    /**
     * CreateGeocode constructor.
     * @param Address $address
     */
    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws GuzzleException
     */
    public function handle()
    {
        Address::init($this->address);
    }

    /**
     * @return array
     */
    public function middleware()
    {
        $rateLimitedMiddleware = (new RateLimited())
            ->allow(5)
            ->everySecond();

        return [$rateLimitedMiddleware];
    }
}
