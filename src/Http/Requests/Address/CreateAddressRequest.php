<?php

namespace Akkurate\LaravelContact\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class CreateAddressRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type_id' => 'nullable|integer',
            'name' => 'nullable|string',
            'street1' => 'required|string',
            'street2' => 'nullable|string',
            'street3' => 'nullable|string',
            'postcode' => 'required|digits:5',
            'city' => 'required|string',
            'priority' => 'nullable|integer',
            'is_default' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'addressable_type' => 'required|string',
            'addressable_id' => 'required|integer',
        ];
    }
}
