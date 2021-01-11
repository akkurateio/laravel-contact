<?php

namespace Akkurate\LaravelContact\Http\Requests\Type;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code' => 'string|required',
            'name' => 'string|required',
            'shortname' => 'string|required',
            'description' => 'string|nullable',
            'priority' => 'numeric|nullable|min:0',
            'is_active' => 'boolean|nullable',
        ];
    }
}
