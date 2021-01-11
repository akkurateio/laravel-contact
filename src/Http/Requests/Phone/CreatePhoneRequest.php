<?php

namespace Akkurate\LaravelContact\Http\Requests\Phone;

use Illuminate\Foundation\Http\FormRequest;

class  CreatePhoneRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'nullable|string',
            'prefix' => 'nullable|string',
            'number' => 'required|digits:10',
            'priority' => 'nullable|integer',
            'is_default' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'phoneable_type' => 'required|string',
            'phoneable_id' => 'required|integer',
            'type_id' => 'nullable|integer',
        ];
    }
}
