<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'branch_id' => ['required', 'exists:branches,id'],
            'semester_id' => ['required', 'exists:semesters,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'author' => ['nullable', 'string', 'max:255'],
            'pages' => ['nullable', 'integer', 'min:1'],
            'price' => ['nullable', 'numeric', 'min:0', 'regex:/^\d{1,6}(\.\d{1,2})?$/'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'file_id' => ['required', 'exists:files,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'branch_id.required' => 'The branch is required.',
            'branch_id.exists' => 'The selected branch is invalid.',
            'semester_id.required' => 'The semester is required.',
            'semester_id.exists' => 'The selected semester is invalid.',
            'title.required' => 'The title is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title must not exceed 255 characters.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description must not exceed 5000 characters.',
            'author.string' => 'The author name must be a string.',
            'author.max' => 'The author name must not exceed 255 characters.',
            'pages.integer' => 'The number of pages must be an integer.',
            'pages.min' => 'The number of pages must be at least 1.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price cannot be negative.',
            'price.regex' => 'The price must not exceed six digits before the decimal and two digits after.',
            'image.image' => 'The cover image must be an image file.',
            'image.mimes' => 'The cover image must be one of the following types: jpeg, png, jpg, gif, or webp.',
            'image.max' => 'The cover image size must not exceed 2MB.',
            'file_id.required' => 'The file is required.',
            'file_id.exists' => 'The selected file is invalid.',
        ];
    }
}
