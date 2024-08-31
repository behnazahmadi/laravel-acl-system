<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class CreateBlogRequest extends FormRequest
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
    public function rules(): array
    {

        return [
            'title' => 'required|string|max:255',
            'status' => 'required|in:APPROVED,PENDING,REJECTED',
            'file_path' => 'sometimes',
            'body' => 'required|string',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The status must be one of the following: APPROVED,PENDING,REJECTED.',
            'file_path.max' => 'The file path may not be greater than 255 characters.',
            'body.required' => 'The body field is required.',
        ];
    }
}
