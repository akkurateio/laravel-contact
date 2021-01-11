<?php


namespace Akkurate\LaravelContact\Classes;

use Illuminate\Validation\ValidationException;

class Contact
{
    /**
     * If the array key exists, it returns its value,
     * else it returns some default value
     * @param array $params
     * @param string $key
     * @param mixed|null $defaultValue
     * @return mixed|null
     */
    public static function getIfExists(array $params, string $key, $defaultValue = null)
    {
        return array_key_exists($key, $params) ? $params[$key] : $defaultValue;
    }

    /**
     * If the array key exists and its value is an object, it returns the id of this object
     * Else if the array key exists and its value is an array, it creates the object with the chosen Class and
     * returns the id of the created object
     * Else, it returns some default value (an id or null)
     * @param array $params
     * @param string $key
     * @param string $class
     * @param null|integer $defaultValue
     * @param array $additionalParams
     * @return null|integer
     */
    public static function getItemId(array $params, string $key, string $class, $defaultValue = null, $additionalParams = [])
    {
        if (array_key_exists($key, $params)) {

            if (is_array($params[$key]) && class_exists($class) && $item = $class::create(array_merge($additionalParams, $params[$key]))) {
                return $item->id;
            }

            if (is_object($params[$key]) && $params[$key]->id) {
                return $params[$key]->id;
            }
        }

        return $defaultValue;
    }

    /**
     * Throws a ValidationException when the validator fails
     * @param $validator
     * @throws ValidationException
     */
    public static function validate($validator)
    {
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}