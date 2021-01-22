<?php

namespace Akkurate\LaravelContact\Traits;

use Akkurate\LaravelContact\Models\Address;
use Akkurate\LaravelContact\Models\Email;
use Akkurate\LaravelContact\Models\Phone;
use Akkurate\LaravelContact\Models\Type;

/**
 * Trait Contactable
 */
trait Contactable
{
    public function emails()
    {
        return $this->morphMany(Email::class, 'emailable');
    }

    public function phones()
    {
        return $this->morphMany(Phone::class, 'phoneable');
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function getAddressAttribute()
    {
        return $this->addresses->where('is_default')->first();
    }

    public function getEmailAttribute()
    {
        return $this->emails->where('is_default')->first();
    }

    public function getPhoneAttribute()
    {
        return $this->phones->where('is_default')->first();
    }

    public function getPhoneFormattedAttribute()
    {
        if (count($this->phones()->where('type_id', Type::where('code', 'WORK')->first()->id)->get())) {
            $phone = $this->phones()->where(['type_id' => Type::where('code', 'WORK')->first()->id])->latest()->first();

            return $this->formatPhone($phone->number);
        } elseif (count($this->phones()->where('type_id', Type::where('code', 'HOME')->first()->id)->get())) {
            $phone = $this->phones()->where(['type_id' => Type::where('code', 'HOME')->first()->id])->latest()->first();

            return $this->formatPhone($phone->number);
        } elseif (count($this->phones()->where('type_id', Type::where('code', 'MOBILE')->first()->id)->get())) {
            $phone = $this->phones()->where(['type_id' => Type::where('code', 'MOBILE')->first()->id])->latest()->first();

            return $this->formatPhone($phone->number);
        } else {
            return 'Aucun numéro enregistré';
        }
    }

    public function formatPhone($number)
    {
        return substr($number, 0, 2) . " "
            . substr($number, 2, 2) . " "
            . substr($number, 4, 2) . " "
            . substr($number, 6, 2) . " "
            . substr($number, 8);
    }

    public function getAddressFormattedAttribute()
    {
        if (count($this->addresses()->where('type_id', Type::where('code', 'HOME')->first()->id)->get())) {
            $address = $this->addresses()->where(['type_id' => Type::where('code', 'HOME')->first()->id])->latest()->first();

            return $this->formatAddress($address);
        } elseif (count($this->addresses()->where('type_id', Type::where('code', 'WORK')->first()->id)->get())) {
            $address = $this->addresses()->where(['type_id' => Type::where('code', 'WORK')->first()->id])->latest()->first();

            return $this->formatAddress($address);
        } elseif (count($this->addresses()->where('type_id', Type::where('code', 'BILLING')->first()->id)->get())) {
            $phone = $this->addresses()->where(['type_id' => Type::where('code', 'BILLING')->first()->id])->latest()->first();

            return $this->formatPhone($phone->number);
        } elseif (count($this->addresses()->where('type_id', Type::where('code', 'DELIVERY')->first()->id)->get())) {
            $phone = $this->addresses()->where(['type_id' => Type::where('code', 'DELIVERY')->first()->id])->latest()->first();

            return $this->formatPhone($phone->number);
        } else {
            return 'Aucune adresse renseignée';
        }
    }

    private function formatAddress($address)
    {
        $addressDisplay = '';
        $addressDisplay .= $address->street1;
        $addressDisplay .= config('laravel-contact.address.display.delimiter');
        if ($address->street2) {
            $addressDisplay .= $address->street2;
            $addressDisplay .= config('laravel-contact.address.display.delimiter');
        }
        if ($address->street3) {
            $addressDisplay .= $address->street3;
            $addressDisplay .= config('laravel-contact.address.display.delimiter');
        }
        $addressDisplay .= $address->zip;
        $addressDisplay .= config('laravel-contact.address.display.delimiter');
        $addressDisplay .= $address->city;

        return $addressDisplay;
    }
}
