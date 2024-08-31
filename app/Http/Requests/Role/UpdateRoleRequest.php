<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $roleId = $this->route('role');

        return [
            'name' => [
                'required',
                'string',
                Rule::unique('roles', 'name')->ignore($roleId),
                'max:255',
            ],
        ];
    }

    /**
     * Customize the error messages for the validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'A role name is required.',
            'name.string' => 'The role name must be a string.',
            'name.unique' => 'The role name has already been taken.',
            'name.max' => 'The role name may not be greater than 255 characters.',
        ];
    }
}
