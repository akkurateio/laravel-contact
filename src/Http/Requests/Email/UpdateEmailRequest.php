<?php

namespace Akkurate\LaravelContact\Http\Requests\Email;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmailRequest extends FormRequest
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
            'email' => 'required|email',
            'priority' => 'nullable|integer',
            'is_default' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'emailable_type' => 'required|string',
            'emailable_id' => 'required|integer',
        ];
    }
}
