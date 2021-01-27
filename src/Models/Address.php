<?php

namespace Akkurate\LaravelContact\Models;

use Akkurate\LaravelContact\Database\Factories\AddressFactory;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Address extends Model
{
    use HasFactory;

    protected $table = 'contact_addresses';
    protected $fillable = ['type_id', 'name','longitude', 'latitude', 'street1', 'street2', 'street3', 'postcode', 'city', 'priority', 'is_default', 'is_active', 'addressable_type', 'addressable_id', 'department_id'];

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string)Uuid::generate(4);
        });
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return AddressFactory::new();
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function addressable()
    {
        return $this->morphTo();
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Fill in the database fields with the government api for the given address.
     *
     * @param Address $address
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function init(Address $address)
    {
        $fullAddress = $address->street1 . ', ' . $address->postcode . ', ' . $address->city;

        $geocodedAddress = Address::callApi($fullAddress);

        $departmentInformations = [];

        if (!empty($geocodedAddress->properties->context)) {
            //0 Number
            //1 Name
            //2 Region
            $departmentInformations = explode(',', $geocodedAddress->properties->context);
        }

        $department = Department::where('number', ltrim($departmentInformations[0]))->where('name', ltrim($departmentInformations[1]))->first();

        $address->update([
            'longitude' => $geocodedAddress->geometry->coordinates[0],
            'latitude' => $geocodedAddress->geometry->coordinates[1],
            'name' => $geocodedAddress->properties->name,
            'housenumber' => $geocodedAddress->properties->housenumber ?? null,
            'department_id' => !empty($department) ? $department->id : null,
        ]);
    }

    /**
     * @param $address
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function callApi($address)
    {
        $client = new Client();
        $res = $client->request('GET', 'https://api-adresse.data.gouv.fr/search/?q=' . urlencode($address));

        $geocodedAddresses = json_decode($res->getBody()->getContents());

        return $geocodedAddresses->features[0] ?? null;
    }
}
