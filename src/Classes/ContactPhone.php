<?php


namespace Akkurate\LaravelContact\Classes;


use Akkurate\LaravelContact\Models\Phone;
use Akkurate\LaravelContact\Models\Type;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ContactPhone
{
    /**
     * Gets default phone type when none is provided
     * @return Type|null
     */
    public static function getDefaultType()
    {
        return ContactType::getByCode('WORK');
    }

    /**
     * Creates a phone number with the given parameters
     * @param array $params
     * @return Phone
     * @throws ValidationException
     */
    public static function create(array $params = [])
    {
        $rules = [
            'name' => 'string|nullable',
            'prefix' => 'string|nullable',
            'number' => 'string|required',
            'priority' => 'integer|min:0|nullable',
            'is_active' => 'boolean|nullable',
            'phoneable_type' => 'string|required',
            'phoneable_id' => 'integer|required',
            'type_id' => 'integer|nullable',
        ];

        Contact::validate(Validator::make($params, $rules));

        $data = [
            'name' => Contact::getIfExists($params, 'name'),
            'prefix' => Contact::getIfExists($params, 'prefix'),
            'number' => $params['number'],
            'priority' => Contact::getIfExists($params, 'priority', 0),
            'is_active' => Contact::getIfExists($params, 'is_active', 1),
            'phoneable_type' => $params['phoneable_type'],
            'phoneable_id' => $params['phoneable_id'],
            'type_id' => Contact::getItemId($params, 'type', Type::class,
                array_key_exists('type_id', $params) ? $params['type_id'] : self::getDefaultType()->id),
        ];

        if ($phone = Phone::where([
            'prefix' => $data['prefix'],
            'number' => $data['number'],
            'phoneable_type' => $data['phoneable_type'],
            'phoneable_id' => $data['phoneable_id'],
            'type_id' => $data['type_id'],
        ])->first()) {
            return $phone;
        }

        return Phone::firstOrCreate($data);
    }
}