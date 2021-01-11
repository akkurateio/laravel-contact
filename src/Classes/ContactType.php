<?php


namespace Akkurate\LaravelContact\Classes;


use Akkurate\LaravelContact\Models\Type;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class ContactType
{
    /**
     * Gets a type by any parameters
     * @param string $key
     * @param string $value
     * @return Type|null
     */
    public static function get(string $key, string $value)
    {
        return Type::where($key, $value)->first();
    }

    /**
     * Gets a type by its code
     * @param string $code
     * @return Type|null
     */
    public static function getByCode(string $code)
    {
        return self::get('code', $code);
    }

    /**
     * Gets a type by its name
     * @param string $name
     * @return Type|null
     */
    public static function getByName(string $name)
    {
        return self::get('name', $name);
    }

    /**
     * Creates a type with the given parameters
     * @param array $params
     * @return Type
     * @throws ValidationException
     */
    public static function create(array $params = [])
    {
        Contact::validate(Validator::make($params, [
            'code' => 'string|required',
            'name' => 'string|required',
            'description' => 'string|required',
            'priority' => 'integer|min:0|nullable',
            'is_active' => 'boolean|nullable',
        ]));

        if ($type = Type::where(['name' => $params['name'], 'code' => $params['code']])->first()) {
            return $type;
        }

        return Type::firstOrCreate([
            'code' => $params['code'],
            'name' => $params['name'],
            'description' => Contact::getIfExists($params, 'description'),
            'priority' => Contact::getIfExists($params, 'priority', 0),
            'is_active' => Contact::getIfExists($params, 'is_active', 1),
        ]);
    }
}