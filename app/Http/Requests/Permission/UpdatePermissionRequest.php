<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePermissionRequest extends FormRequest
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
        $permissionId = $this->route('permission');

        return [
            'name' => [
                'required',
                'string',
                Rule::unique('permissions', 'name')->ignore($permissionId),
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
            'name.required' => 'A permission name is required.',
            'name.string' => 'The permission name must be a string.',
            'name.unique' => 'The permission name has already been taken.',
            'name.max' => 'The permission name may not be greater than 255 characters.',
        ];
    }
}
