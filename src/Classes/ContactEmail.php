<?php


namespace Akkurate\LaravelContact\Classes;


use Akkurate\LaravelContact\Models\Email;
use Akkurate\LaravelContact\Models\Type;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ContactEmail
{

    /**
     * Gets default email type when none is provided
     * @return Type|null
     */
    public static function getDefaultType()
    {
        return ContactType::getByCode('WORK');
    }

    /**
     * Creates an email address with the given parameters
     * @param array $params
     * @return Email
     * @throws ValidationException
     */
    public static function create(array $params = [])
    {
        $rules = [
            'name' => 'string|nullable',
            'email' => 'string|required|email:rfc,dns|max:255',
            'priority' => 'integer|min:0|nullable',
            'is_active' => 'boolean|nullable',
            'emailable_type' => 'string|required',
            'emailable_id' => 'integer|required',
            'type_id' => 'integer|nullable',
        ];

        Contact::validate(Validator::make($params, $rules));

        $data = [
            'name' => Contact::getIfExists($params, 'name'),
            'email' => $params['email'],
            'priority' => Contact::getIfExists($params, 'priority', 0),
            'is_active' => Contact::getIfExists($params, 'is_active', 1),
            'emailable_type' => $params['emailable_type'],
            'emailable_id' => $params['emailable_id'],
            'type_id' => Contact::getItemId($params, 'type', Type::class,
                array_key_exists('type_id', $params) ? $params['type_id'] : self::getDefaultType()->id),
        ];

        if ($email = Email::where([
            'email' => $data['email'],
            'emailable_type' => $data['emailable_type'],
            'emailable_id' => $data['emailable_id'],
            'type_id' => $data['type_id'],
        ])->first()) {
            return $email;
        }

        return Email::firstOrCreate($data);
    }
}