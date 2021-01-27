<?php

namespace Akkurate\LaravelContact\Observers;

use Akkurate\LaravelContact\Jobs\CreateGeocode;
use Akkurate\LaravelContact\Models\Address;

/**
 * Class AddressObserver
 * @package App\Observers
 */
class AddressObserver
{
    /**
     * Handle the Address "created" event.
     *
     * @param Address $address
     * @return void
     */
    public function created(Address $address)
    {
        CreateGeocode::dispatch($address);
    }

    /**
     * Handle the Address "updated" event.
     *
     * @param Address $address
     * @return void
     */
    public function updated(Address $address)
    {
        CreateGeocode::dispatch($address);
    }
}
