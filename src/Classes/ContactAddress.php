<?php


namespace Akkurate\LaravelContact\Classes;


use Akkurate\LaravelContact\Models\Address;
use Akkurate\LaravelContact\Models\Type;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ContactAddress
{
    /**
     * Gets default address type when none is provided
     * @return Type|null
     */
    public static function getDefaultType()
    {
        return ContactType::getByCode('WORK');
    }

    /**
     * Creates an address with the given parameters
     * @param array $params
     * @return Address
     * @throws ValidationException
     */
    public static function create(array $params = [])
    {
        $rules = [
            'name' => 'string|nullable',
            'street1' => 'string|required',
            'street2' => 'string|nullable',
            'street3' => 'string|nullable',
            'zip' => 'string|required',
            'city' => 'string|required',
            'priority' => 'integer|min:0|nullable',
            'is_default' => 'boolean|nullable',
            'is_active' => 'boolean|nullable',
            'addressable_type' => 'string|required',
            'addressable_id' => 'integer|required',
            'type_id' => 'integer|nullable',
        ];

        Contact::validate(Validator::make($params, $rules));

        $data = [
            'name' => Contact::getIfExists($params, 'name'),
            'street1' => Contact::getIfExists($params, 'street1'),
            'street2' => Contact::getIfExists($params, 'street2'),
            'street3' => Contact::getIfExists($params, 'street3'),
            'zip' => Contact::getIfExists($params, 'zip'),
            'city' => Contact::getIfExists($params, 'city'),
            'priority' => Contact::getIfExists($params, 'priority', 0),
            'is_default' => Contact::getIfExists($params, 'is_default', 0),
            'is_active' => Contact::getIfExists($params, 'is_active', 1),
            'addressable_type' => $params['addressable_type'],
            'addressable_id' => $params['addressable_id'],
            'type_id' => Contact::getItemId($params, 'type', Type::class,
                array_key_exists('type_id', $params) ? $params['type_id'] : self::getDefaultType()->id),
        ];

        if ($address = Address::where([
            'street1' => $data['street1'],
            'street2' => $data['street2'],
            'street3' => $data['street3'],
            'zip' => $data['zip'],
            'city' => $data['city'],
            'addressable_type' => $data['addressable_type'],
            'addressable_id' => $data['addressable_id'],
            'type_id' => $data['type_id'],
        ])->first()) {
            return $address;
        }

        return Address::firstOrCreate($data);
    }
}
